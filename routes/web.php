<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//pages
Route::get('/', function () {
    return view('index');
});

Route::get('/addarticle', function () {
    return view('addarticle');
});

Route::get('/login', function () {
	return view('login');
});

Route::get('/register', function () {
	return view('register');
});


//board date
Route::get('/articles', 'ArticleController@index');


// Route::get('/checklogin', 'HomeController@checklogin');

