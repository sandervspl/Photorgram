<?php
Route::get('/', function (){ return view('index'); });

Route::get('/login', function (){ return view('login'); });
Route::get('/register', function (){ return view('register'); });

Route::get('/images', 'ImageController@all');
Route::get('/images/all', 'ImageController@all');
Route::get('/images/upload', 'ImageController@upload');
Route::get('/images/result', 'ImageController@result');
Route::get('/images/category/{categoryname}', 'ImageController@category');
Route::get('/images/{id}', 'ImageController@show');
Route::get('/images/{id}/edit', 'ImageController@edit');
Route::post('/images/edit', 'ImageController@update');
Route::post('/images/upload', 'ImageController@process');

Route::get('/profile', 'ProfileController@index');
Route::get('/{userid}/{imageid}', 'ProfileController@showImage');
Route::get('/profile/{userid}', 'ProfileController@show');

Route::get('/{userid}', 'ProfileController@show');

Auth::routes();
Route::get('/home', 'HomeController@index');
Auth::routes();
Route::get('/home', 'HomeController@index');
