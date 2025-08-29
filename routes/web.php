<?php

use App\Models\Role;
use Illuminate\Support\Facades\Route;

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
    return view('admin-files');
});


Route::group(['middleware' => ['auth', 'hasPermission:admin_test']], function () {
    Route::get('/admin-files', function () {
        return view('admin-files');
    });
});
