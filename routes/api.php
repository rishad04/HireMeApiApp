<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use PharIo\Manifest\AuthorCollection;
use App\Http\Controllers\Api\JobController;
use App\Http\Controllers\Api\Auth\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// Auth routes
Route::group(['middleware' => ['guest']], function () {
    // Route::prefix(['v1/auth'], function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    // });
});

Route::group(['middleware' => ['auth']], function () {
    // Route::prefix(['v1/auth'], function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/get-profile', [AuthController::class, 'getProfile']);
    // });
});

Route::get('/jobs', [JobController::class, 'index']);
