<?php

namespace App\Http\Controllers\Admin;

use stdClass;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $info = new stdClass();
        $info->first_button_title = 'Create';
        $info->first_button_route = 'users.create';

        $data = User::where('role_id', 3)->orderBy('id', 'desc')->paginate(10);
        return view('backend.users.index', compact('data', 'info'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $info = new stdClass();
        $info->title = 'Users';
        $info->first_button_title = 'Users Create';
        $info->first_button_route = 'users.create';
        $info->route_index = 'users.index';
        $info->form_route = 'users.store';
        $info->description = 'These all are users';

        return view('backend.users.create', compact('info'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role_id' => 3,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
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
        $page_title = 'Users';
        $info = new stdClass();
        $info->title = 'Users';
        $info->first_button_title = 'Users';
        $info->first_button_route = 'users.create';
        $info->route_index = 'users.index';
        $info->description = 'These all are users';

        $data = User::find($id);
        return view('users.edit', compact('data', 'info'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $user = User::find($id);

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:8',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
        ]);

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $page_title = 'Users';
        $info = new stdClass();
        $info->title = 'Users';
        $info->first_button_title = 'Users';
        $info->first_button_route = 'users.create';
        $info->route_index = 'users.index';
        $info->description = 'These all are users';
    }
}
