<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\UserApplication;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\UserApplicationResourceCollection;

class ApplicationController extends Controller
{

    public function uploadCv(Request $request)
    {
        Log::info('application cv ', [$request->all()]);
        $validated = $request->validate([
            'application_id' => 'required|exists:user_applications,id',
            'cv' => 'required|file|mimes:pdf,png,jpg,jpeg|max:5120', // max:5120 is 5MB
        ]);

        $application = UserApplication::findOrFail($validated['application_id']);


        if (Auth::id() !== $application->user_id) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        $path = $request->file('cv')->store('resumes', 'public');

        $application->update([
            'resume' => $path
        ]);

        return response()->json(['message' => 'CV uploaded successfully!']);
    }
}
