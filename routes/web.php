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

//get items
Route::get('api/articles/paginate', 'ArticleController@index');
Route::get('api/articlesPremium', 'ArticleController@all');
Route::get('api/users', 'UserController@find');
Route::get('api/user', 'UserController@show');
Route::get('api/categories', 'CategoriesController@index');

//searchPage
Route::post('api/filterArticles', 'ArticleController@filter');

//articlePage
Route::get('api/userArticle', 'ArticleController@user');
Route::get('api/articles', 'ArticleController@find');

Route::middleware('auth:api')->group(function (){
	Route::post('api/addArticle', 'ArticleController@create');
	Route::post('api/addComment', 'CommentController@create');
	Route::get('api/authUser', 'UserController@auth');
	Route::get('api/getArticles', 'UserController@article');
	Route::get('api/getMessages', 'UserController@getMessages');
	Route::get('api/removeArticle', 'ArticleController@remove');
	Route::post('api/articleUpdate', 'ArticleController@update');
	Route::post('api/messageCreate', 'MessageController@create');
	Route::post('api/messageUpdate', 'MessageController@update');
	Route::get('api/getMessagesForChat', 'MessageController@getMessagesForChat');
	Route::post('api/updateUser', 'UserController@update');
});

Route::get('/{any?}', function (){
	return view('index');
})->where('any', '^(?!api\/)[\/\w\.-]*');



