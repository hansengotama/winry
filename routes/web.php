<?php

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

Route::get('/invitations/{token}', function () {
    return view('guest.index');
});

Route::get('/not-found', function () {
    return view('guest.index');
});

Route::get('/admin/login', function () {
    return view('admin.index');
});

Route::get('/admin/manage-guest', function () {
    return view('admin.index');
});

Route::get('/admin/manage-guest-group', function () {
    return view('admin.index');
});