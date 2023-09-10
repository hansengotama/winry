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
    Route::prefix('/auth')->group(function() {
        Route::post('/login', 'AuthController@login');    

        Route::middleware('auth:sanctum')->group(function() {
            Route::get('/user', 'AuthController@user');
            Route::post('/logout', 'AuthController@logout');
        });
    });


    Route::prefix('/admin')->group(function() {
        Route::middleware('auth:sanctum')->group(function() {
            Route::prefix('/guesses')->group(function() {
                Route::get('/', 'GuessController@get');
                Route::post('/', 'GuessController@create');
                Route::put('/{id}', 'GuessController@update');
            });
        
            Route::prefix('/guess-groups')->group(function() {
                Route::get('/', 'GuessGroupController@get');
                Route::post('/', 'GuessGroupController@create');
                Route::put('/{id}', 'GuessGroupController@update');
            });
        });
    });
});