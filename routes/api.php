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

//Route::middleware('auth:api')->get('/auth', function (Request $request) {
//    return $request->user();
//});

//register
Route::post('auth/register', 'Auth\RegisterController@register');

//auth

Route::prefix('auth')->group(function ($router) {
    // Below mention routes are public, user can access those without any restriction.

    // Login User
    Route::post('login', 'AuthController@login');

    // Refresh the JWT Token
    Route::get('refresh', 'AuthController@refresh');

    // Below mention routes are available only for the authenticated users.
    Route::middleware('auth:api')->group(function () {
        // Get user info
        Route::get('user', 'AuthController@user');
        // Logout user from application
        Route::post('logout', 'AuthController@logout');
    });
});

Route::post('addArticle', 'ArticleController@create');

Route::get('user', 'UserController@index');
