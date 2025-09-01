<?php

namespace App\Http\Controllers\Admin;

use App\Models\Job;
use App\Models\Company;
use Illuminate\Http\Request;
use App\Models\UserApplication;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function index()
    {

        $data = [];

        if (auth()->guard('admin')->user()->role->slug == 'admin') {


            $data['total_company'] = Company::count();
            $data['total_job'] = Job::count();
            $data['total_applicant'] = UserApplication::count();
            $data['total_income'] = UserApplication::sum('paid');


            return view('backend.admin-dashboard', compact('data'));
        } elseif (auth()->guard('admin')->user()->role->slug == 'recruiter') {

            $data['total_job'] = Job::where('company_id', auth()->guard('admin')->user()->company_id)->count();
            $data['total_applicant'] = UserApplication::whereHas('job.company', function ($query) {
                $query->where('id', auth()->guard('admin')->user()->company_id);
            })->count();

            return view('backend.recruiter-dashboard', compact('data'));
        } else {
            return 403;
        }



        return 'forbidden!';
    }
}
