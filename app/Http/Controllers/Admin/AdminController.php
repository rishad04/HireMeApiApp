<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {

        if (auth()->guard('admin')->user()->role->slug == 'admin') {
            return view('backend.admin-dashboard');
        } elseif (auth()->guard('admin')->user()->role->slug == 'recruiter') {
            return view('backend.recruiter-dashboard');
        } else {
            return 403;
        }



        return 'forbidden!';
    }
}
