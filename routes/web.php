<?php

use App\Models\Role;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminController;
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
        Route::post('/logout', 'logout')->name('admin.logout');
    });
});



Route::group(['middleware' => ['auth', 'hasPermission:admin_test']], function () {
    Route::get('/admin-files', function () {
        return view('admin-files');
    });
});
Route::group(['middleware' => ['auth:admin']], function () {

    Route::get('admin/users',                       [UserController::class, 'index'])->name('users.index')->middleware('hasAdminPermission:user_view');

    Route::get('admin/users/create',                [UserController::class, 'create'])->name('users.create')->middleware('hasAdminPermission:user_create');
    Route::post('admin/users/store',                [UserController::class, 'store'])->name('users.store')->middleware('hasAdminPermission:user_create');
    Route::get('admin/users/edit/{id}',             [UserController::class, 'edit'])->name('users.edit')->middleware('hasAdminPermission:user_update');
    Route::put('admin/users/update',                [UserController::class, 'update'])->name('users.update')->middleware('hasAdminPermission:user_update');
    Route::get('admin/users/permissions/{id}',      [UserController::class, 'permission'])->name('users.permission')->middleware('hasAdminPermission:permission_update');
    Route::put('admin/users/permissions/update',    [UserController::class, 'permissionsUpdate'])->name('users.permissions.update')->middleware('hasAdminPermission:permission_update');
    Route::delete('admin/user/delete/{id}',         [UserController::class, 'delete'])->name('users.delete')->middleware('hasAdminPermission:user_delete');


    // Route::get('users', [UserController::class, 'index'])->name('user.index')->middleware('hasAdminPermission:user_view');
    // Route::post('users', [UserController::class, 'index'])->name('user.index')->middleware('hasAdminPermission:user_view');
});
