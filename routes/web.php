<?php

use App\Models\Role;
use App\Models\User;
use Faker\Provider\el_CY\Company;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\JobController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\RecruiterController;
use App\Http\Controllers\Admin\Auth\LoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [AdminController::class, 'index'])->name('admin-dashboard');

Route::get('/create-token/{id}', function ($id) {
    $user = User::findOrFail($id);
    $token = JWTAuth::fromUser($user);

    return response()->json([
        'user_id' => $user->id,
        'token' => $token,
    ]);
});

Route::prefix('admin')->group(function () {
    Route::controller(LoginController::class)->group(function () {
        Route::get('/login', 'showLoginForm')->name('admin.login');
        Route::post('/login', 'login')->name('admin.login.submit');
        Route::post('demo/login', 'adminDemoLogin')->name('admin.demo.login.submit');
        Route::post('recruiter/demo/login', 'recruiterDemoLogin')->name('recruiter.demo.login.submit');
        Route::post('/logout', 'logout')->name('admin.logout');
    });
});



Route::group(['middleware' => ['auth', 'hasPermission:admin_test']], function () {
    Route::get('/admin-files', function () {
        return view('admin-files');
    });
});
Route::group(['middleware' => ['auth:admin']], function () {

    // Users
    Route::get('admin/users',                       [UserController::class, 'index'])->name('users.index')->middleware('hasAdminPermission:user_view');

    Route::get('admin/users/create',                [UserController::class, 'create'])->name('users.create')->middleware('hasAdminPermission:user_create');

    Route::post('admin/users/store',                [UserController::class, 'store'])->name('users.store')->middleware('hasAdminPermission:user_create');

    Route::get('admin/users/edit/{id}',             [UserController::class, 'edit'])->name('users.edit')->middleware('hasAdminPermission:user_edit');

    Route::put('admin/users/update/{id}', [UserController::class, 'update'])->name('users.update')->middleware('hasAdminPermission:user_edit');

    Route::delete('admin/user/delete/{id}',         [UserController::class, 'destroy'])->name('users.delete')->middleware('hasAdminPermission:user_delete');

    // company
    Route::get('admin/company',                       [CompanyController::class, 'index'])->name('company.index')->middleware('hasAdminPermission:company_view');

    Route::get('admin/company/create',                [CompanyController::class, 'create'])->name('company.create')->middleware('hasAdminPermission:company_create');

    Route::post('admin/company/store',                [CompanyController::class, 'store'])->name('company.store')->middleware('hasAdminPermission:company_create');

    Route::get('admin/company/edit/{id}',             [CompanyController::class, 'edit'])->name('company.edit')->middleware('hasAdminPermission:company_edit');

    Route::put('admin/company/update/{id}', [CompanyController::class, 'update'])->name('company.update')->middleware('hasAdminPermission:company_edit');

    Route::delete('admin/company/delete/{id}',         [CompanyController::class, 'destroy'])->name('company.delete')->middleware('hasAdminPermission:company_delete');

    // recruiter
    Route::get('admin/recruiter', [RecruiterController::class, 'index'])->name('recruiter.index')->middleware('hasAdminPermission:recruiter_view');

    Route::get('admin/recruiter/create',                [RecruiterController::class, 'create'])->name('recruiter.create')->middleware('hasAdminPermission:recruiter_create');

    Route::post('admin/recruiter/store',                [RecruiterController::class, 'store'])->name('recruiter.store')->middleware('hasAdminPermission:recruiter_create');

    Route::get('admin/recruiter/edit/{id}',             [RecruiterController::class, 'edit'])->name('recruiter.edit')->middleware('hasAdminPermission:recruiter_edit');

    Route::put('admin/recruiter/update/{id}', [RecruiterController::class, 'update'])->name('recruiter.update')->middleware('hasAdminPermission:recruiter_edit');

    Route::delete('admin/recruiter/delete/{id}',         [RecruiterController::class, 'destroy'])->name('recruiter.delete')->middleware('hasAdminPermission:recruiter_delete');


    // job
    Route::get('admin/job', [JobController::class, 'index'])->name('job.index')->middleware('hasAdminPermission:job_view');

    Route::get('admin/job/create',                [JobController::class, 'create'])->name('job.create')->middleware('hasAdminPermission:job_create');

    Route::post('admin/job/store',                [JobController::class, 'store'])->name('job.store')->middleware('hasAdminPermission:job_create');

    Route::get('admin/job/edit/{id}',             [JobController::class, 'edit'])->name('job.edit')->middleware('hasAdminPermission:job_edit');

    Route::put('admin/job/update/{id}', [JobController::class, 'update'])->name('job.update')->middleware('hasAdminPermission:job_edit');

    Route::delete('admin/job/delete/{id}',         [JobController::class, 'destroy'])->name('job.delete')->middleware('hasAdminPermission:job_delete');
});
