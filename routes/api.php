<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::namespace('App\Http\Controllers')->prefix('/auth')->group(function() {
    Route::middleware('auth:sanctum')->group(function() {
        Route::get('/user', 'AuthController@user');
        Route::get('/logout', 'AuthController@logout');
    });

    Route::post('/login', 'AuthController@login');    
});
