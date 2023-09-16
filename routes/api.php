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


Route::namespace('App\Http\Controllers')->group(function() {
    Route::get('/invitations/{token}', 'GuestController@getByGuest');

    Route::prefix('/admin/auth')->group(function() {
        Route::post('/login', 'AuthController@login');    

        Route::middleware('auth:sanctum')->group(function() {
            Route::get('/user', 'AuthController@user');
            Route::post('/logout', 'AuthController@logout');
        });
    });

    Route::prefix('/admin')->group(function() {
        Route::middleware('auth:sanctum')->group(function() {
            Route::prefix('/guests')->group(function() {
                Route::get('/', 'GuestController@get');
                Route::post('/', 'GuestController@create');
                Route::put('/{id}', 'GuestController@update');
            });
        
            Route::prefix('/guest-groups')->group(function() {
                Route::get('/', 'GuestGroupController@get');
                Route::post('/', 'GuestGroupController@create');
                Route::put('/{id}', 'GuestGroupController@update');
            });
        });
    });
});