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

//get items
Route::get('api/articles', 'ArticleController@index');
Route::get('api/cities', 'CityController@index');
Route::get('api/regions', 'RegionController@index');
Route::get('api/categories', 'CategoriesController@index');

Route::get('/{any?}', function (){
	return view('index');
})->where('any', '^(?!api\/)[\/\w\.-]*');

// Route::get('/checklogin', 'HomeController@checklogin');

