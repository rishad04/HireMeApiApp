<?php

namespace App\Http\Controllers\Admin;

use stdClass;
use App\Models\Role;
use App\Models\Admin;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class RecruiterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $info = new stdClass();
        $info->first_button_title = 'Create';
        $info->first_button_route = 'recruiter.create';

        $data = Admin::where('is_recruiter', 1)->where('role_id', 2)->orderBy('id', 'desc')->paginate(10);

        // dd($data);
        return view('backend.recruiter.index', compact('data', 'info'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $info = new stdClass();
        $info->title = 'Recruiter';
        $info->first_button_title = 'Recruiter Create';
        $info->first_button_route = 'recruiter.create';
        $info->route_index = 'recruiter.index';
        $info->form_route = 'recruiter.store';
        $info->description = 'These all are recruiter';

        $companies = Company::get();

        return view('backend.recruiter.create', compact('info', 'companies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:admins',
            'password' => 'required|min:6',
            'company' => 'required',
        ]);

        $row = new Admin();
        $row->name = $request->name;
        $row->email = $request->email;
        $row->password = Hash::make($request->email);
        $row->company_id = $request->company;
        $row->is_recruiter = 1;
        $row->role_id = Role::where('slug', 'recruiter')->value('id');
        $row->save();

        return redirect()->route('recruiter.index')->with('success', 'Recruiter created successfully.');
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
        $page_title = 'Recruiter';
        $info = new stdClass();
        $info->title = 'Recruiter';
        $info->first_button_title = 'Recruiter';
        $info->first_button_route = 'recruiter.create';
        $info->route_index = 'recruiter.index';
        $info->form_route = 'recruiter.update';
        $info->description = 'These all are recruiter';

        $companies = Company::get();
        $data = Admin::find($id);
        return view('backend.recruiter.edit', compact('data', 'info', 'companies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {



        $request->validate([
            'name' => 'required',
            'email' => [
                'required',
                'email',
                Rule::unique('admins')->ignore($id),
            ],
            'password' => 'nullable|min:6',
            'company' => 'required',
        ]);

        $row = Admin::find($id);
        $row->name = $request->name;
        $row->email = $request->email;
        $row->password = $request->password ? Hash::make($request->password) : $row->password;
        $row->company_id = $request->company;
        $row->is_recruiter = 1;
        $row->role_id = Role::where('slug', 'recruiter')->value('id');
        $row->save();

        return redirect()->route('recruiter.index')->with('success', 'Recruiter updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //

        Admin::find($id)->delete();

        return redirect()->route('recruiter.index')->with('success', 'Recruiter deleted successfully.');
    }
}
