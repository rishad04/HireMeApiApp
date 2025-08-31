<?php

namespace App\Http\Controllers\Admin;

use stdClass;
use App\Models\Job;
use App\Models\Role;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $info = new stdClass();
        $info->first_button_title = 'Create';
        $info->first_button_route = 'job.create';

        $data = Job::with('company')->orderBy('id', 'desc')->paginate(10);

        return view('backend.job.index', compact('data', 'info'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $info = new stdClass();
        $info->title = 'job';
        $info->first_button_title = 'job Create';
        $info->first_button_route = 'job.create';
        $info->route_index = 'job.index';
        $info->form_route = 'job.store';
        $info->description = 'These all are job';

        $companies = Company::get();

        return view('backend.job.create', compact('info', 'companies'));
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

        return redirect()->route('job.index')->with('success', 'job created successfully.');
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
        $page_title = 'job';
        $info = new stdClass();
        $info->title = 'job';
        $info->first_button_title = 'job';
        $info->first_button_route = 'job.create';
        $info->route_index = 'job.index';
        $info->form_route = 'job.update';
        $info->description = 'These all are job';

        $companies = Company::get();
        $data = Job::find($id);
        return view('backend.job.edit', compact('data', 'info', 'companies'));
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

        return redirect()->route('job.index')->with('success', 'job updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //

        Job::find($id)->delete();

        return redirect()->route('job.index')->with('success', 'job deleted successfully.');
    }
}
