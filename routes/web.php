<?php
Route::get('/', function (){ return view('index'); });

Route::get('/login', function (){ return view('login'); });
Route::get('/register', function (){ return view('register'); });

Route::get('/images', 'ImageController@index');
Route::get('/images/all', 'ImageController@index');
Route::get('/images/upload', 'ImageController@upload');
Route::get('/images/result', 'ImageController@result');
Route::get('/images/{id}', 'ImageController@show');
Route::post('/images/upload', 'ImageController@process');

Route::get('/profile', 'ProfileController@selectProfile');
Route::get('/profile/{userid}/image/{id}', 'ProfileController@showImage');
Route::get('/profile/{userid}', 'ProfileController@show');

Auth::routes();
Route::get('/home', 'HomeController@index');
Auth::routes();
Route::get('/home', 'HomeController@index');
