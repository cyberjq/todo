<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('auth') -> group(function ( ) {
    // Below mention routes are public, user can access those without any restriction.
    // Create New User
    Route::post('register', 'AuthController@register');
    // Login User
    Route::post('login', 'AuthController@login');

    // Refresh the JWT Token
    Route::get('refresh', 'AuthController@refresh');

    // Below mention routes are available only for the authenticated users.
    Route::middleware('auth:api')->group(function () {
        // Get user info
        Route::get('user', 'AuthController@user');
        Route::get('todolist', 'TaskController@index');
        Route::post('todolist/create', 'TaskController@create');
        Route::post('todolist/update', 'TaskController@update');
        Route::post('todolist/update_status', 'TaskController@updateStatus');
        Route::post('todolist/destroy', 'TaskController@destroy');
        // Logout user from application
        Route::post('logout', 'AuthController@logout');
    });
});

Route::middleware('auth:api')->group(function () {
    Route::resource('user', 'UserController')->only(['index','show']);
});
