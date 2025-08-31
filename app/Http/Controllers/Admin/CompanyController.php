<?php

namespace App\Http\Controllers\Admin;

use stdClass;
use App\Models\Role;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $info = new stdClass();
        $info->first_button_title = 'Create';
        $info->first_button_route = 'company.create';

        $data = Company::orderBy('id', 'desc')->paginate(10);
        return view('backend.company.index', compact('data', 'info'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $info = new stdClass();
        $info->title = 'Company';
        $info->page_title = 'Company';
        $info->first_button_title = 'Company Create';
        $info->first_button_route = 'company.create';
        $info->route_index = 'company.index';
        $info->form_route = 'company.store';
        $info->description = 'These all are company';

        return view('backend.company.create', compact('info'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:companies,slug',
        ]);

        $row = new Company();
        $row->name = $request->name;
        $row->slug = $request->slug;
        $row->save();

        return redirect()->route('company.index')->with('success', 'Company created successfully.');
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
        $page_title = 'Company';
        $info = new stdClass();
        $info->title = 'Company';
        $info->first_button_title = 'Company';
        $info->first_button_route = 'company.create';
        $info->route_index = 'company.index';
        $info->form_route = 'company.update';
        $info->description = 'These all are company';

        $data = Company::find($id);
        return view('backend.company.edit', compact('data', 'info'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $company = Company::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'slug' => [
                'required',
                Rule::unique('companies')->ignore($id),
            ],
        ]);

        $company->name = $request->name;
        $company->slug = $request->slug;
        $company->save();

        return redirect()->route('company.index')->with('success', 'Company updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Company::find($id)->delete();

        return redirect()->route('company.index')->with('success', 'Company deleted successfully.');
    }
}
