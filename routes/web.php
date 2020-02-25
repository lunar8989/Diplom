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

Route::get('/user/dashboard', function () {
	return view('user');
});

//get items
Route::get('api/articles', 'ArticleController@index');

Route::get('/{any?}', function (){
	return view('index');
})->where('any', '^(?!api\/)[\/\w\.-]*');

// Route::get('/checklogin', 'HomeController@checklogin');

