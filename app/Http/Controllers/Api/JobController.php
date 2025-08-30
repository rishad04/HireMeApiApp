<?php

namespace App\Http\Controllers\Api;

use App\Models\Job;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\JobCollection;

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
                    ->orWhere('type', 'like', '%' . $searchTerm . '%')
                    ->orWhere('location', 'like', '%' . $searchTerm . '%')
                    ->orWhereHas('company', function ($companyQuery) use ($searchTerm) {
                        $companyQuery->where('name', 'like', '%' . $searchTerm . '%');
                    });
            });
        }

        // Execute the query
        $jobs = $query->latest()->get();

        // return response()->json($jobs);

        $params = [];
        $params['user'] = Auth::guard('api')->user();

        return new JobCollection($jobs, $params);
    }

    public function show($id)
    {
        $data = Job::with('company')->find($id);

        if (!$data) {
            return response()->json(null, 404);
        }

        return response()->json($data);
    }
}
