<?php

namespace App\Http\Controllers\Admin;

use stdClass;
use App\Models\Job;
use App\Models\Role;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Models\UserApplication;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $info = new stdClass();
        $info->first_button_title = 'Create';
        $info->first_button_route = 'application.create';

        $auth_admin = auth()->guard('admin')->user();

        // dd($auth_admin->role->permissions);

        if ($auth_admin->role?->slug == 'admin') {
            $data = UserApplication::with('job.company')->orderBy('id', 'desc')->paginate(10);
        } else {
            $data = UserApplication::whereHas('job.company', function ($query) use ($auth_admin) {
                $query->where('id', $auth_admin->company_id);
            })
                ->where('payment_status', 'paid')
                ->orderBy('id', 'desc')->paginate(10);
        }

        return view('backend.application.index', compact('data', 'info'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $info = new stdClass();
        $info->title = 'application';
        $info->first_button_title = 'application Create';
        $info->first_button_route = 'application.create';
        $info->route_index = 'application.index';
        $info->form_route = 'application.store';
        $info->description = 'These all are application';

        $companies = Company::get();

        return view('backend.application.create', compact('info', 'companies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required',
            'company' => 'required',
            'type' => 'required',
            'location' => 'required',
            'description' => 'required',
            'short_description' => 'nullable',

        ]);

        $row = new Job();
        $row->title = $request->title;
        $row->company_id = $request->company;
        $row->type = $request->type;
        $row->location = $request->location;
        $row->short_description = $request->short_description;
        $row->description = $request->description;
        $row->created_by_admin_id = Auth::guard('admin')->user()->id;
        $row->save();

        return redirect()->route('application.index')->with('success', 'application created successfully.');
    }

    /**
     * Display the specified resource.
     */


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $page_title = 'application';
        $info = new stdClass();
        $info->title = 'application';
        $info->first_button_title = 'application';
        $info->first_button_route = 'application.create';
        $info->route_index = 'application.index';
        $info->form_route = 'application.update';
        $info->description = 'These all are application';

        $companies = Company::get();
        $data = Job::find($id);
        return view('backend.application.edit', compact('data', 'info', 'companies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {



        $request->validate([
            'title' => 'required',
            'company' => 'required',
            'type' => 'required',
            'location' => 'required',
            'description' => 'required',
            'short_description' => 'nullable',
        ]);

        $row = Job::find($id);
        $row->title = $request->title;
        $row->company_id = $request->company;
        $row->type = $request->type;
        $row->location = $request->location;
        $row->short_description = $request->short_description;
        $row->description = $request->description;
        $row->created_by_admin_id = Auth::guard('admin')->user()->id;
        $row->save();

        return redirect()->route('application.index')->with('success', 'application updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //

        UserApplication::find($id)->delete();

        return redirect()->route('application.index')->with('success', 'application deleted successfully.');
    }


    public function accept($id)
    {
        $row = UserApplication::find($id);
        $row->status = 'accepted';
        $row->save();

        return redirect()->route('application.index')->with('success', 'application accepted successfully.');
    }

    public function reject($id)
    {
        $row = UserApplication::find($id);
        $row->status = 'rejected';
        $row->save();

        return redirect()->route('application.index')->with('success', 'application rejected successfully.');
    }
}
