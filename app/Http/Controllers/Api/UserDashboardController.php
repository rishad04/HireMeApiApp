<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\UserApplication;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserApplicationResourceCollection;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Eager-load the job and its company for efficiency
        $applications = UserApplication::with(['job.company'])->where('user_id', $user->id)->get();

        // Return the data using the resource collection
        return new UserApplicationResourceCollection($applications);
    }

    public function destroy($id)
    {

        $user_application =  UserApplication::find($id);
        if (!$user_application) {
            return response()->json(['message' => 'Application History Not Found!'], 404);
        }
        $user_application->delete();

        return response()->json(['message' => 'Application successfully deleted.']);
    }
}
