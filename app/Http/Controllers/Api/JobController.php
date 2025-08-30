<?php

namespace App\Http\Controllers\Api;

use App\Models\Job;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class JobController extends Controller
{
    public function index(Request $request)
    {
        $query = Job::with('company');

        // Check if a 'search' parameter exists in the request URL
        if ($request->has('search') && $request->input('search') != '') {
            $searchTerm = $request->input('search');

            // Add conditions to search in the job title, location,
            // or the related company's name.
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'like', '%' . $searchTerm . '%')
                    ->orWhere('location', 'like', '%' . $searchTerm . '%')
                    ->orWhereHas('company', function ($companyQuery) use ($searchTerm) {
                        $companyQuery->where('name', 'like', '%' . $searchTerm . '%');
                    });
            });
        }

        // Execute the query
        $jobs = $query->latest()->get();

        return response()->json($jobs);
    }
}
