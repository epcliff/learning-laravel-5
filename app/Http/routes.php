<?php

use App\Http\Controllers\FooController;

Route::get('foo', 'FooController@foo');

Route::get('tags/{tags}', 'TagsController@show');



//interface BarInterface {}

//class Bar implements BarInterface {}
//class SecondBar implements BarInterface {}
//
//App::bind('BarInterface', 'SecondBar');
//
//Route::get('bar', function(BarInterface $bar) {
//	dd($bar);
//});
//
//Route::get('/', function() {
//	return 'Home Page';
//});
//Route::get('about', 'PagesController@about');
//Route::get('about', ['middleware' => 'auth', 'uses' => 'PagesController@about']);
Route::get('about', ['middleware' => 'auth', function()
{
	return 'this page will only show if the user is signed in';
}]);

//Route::get('foo',['middleware' => 'manager', function()
//{
//	return 'this page will only be viewed by a manager';
//}]);

Route::get('contact', 'PagesController@contact');

//Route::get('foo', function()
//{
//	return 'Bar';
//});
//
//Route::get('articles', 'ArticlesController@index');
//Route::get('articles/create', 'ArticlesController@create');
//Route::get('articles/{id}', 'ArticlesController@show');
//Route::post('articles', 'ArticlesController@store');
//Route::get('articles/{id}/edit', 'ArticlesController@edit');

Route::resource('articles', 'ArticlesController');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController'
]);