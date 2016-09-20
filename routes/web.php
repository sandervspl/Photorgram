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
Route::get('/images/{imagename}/edit', 'ImageController@edit');
Route::post('/images/edit', 'ImageController@update');
Route::post('/images/upload', 'ImageController@process');

Route::get('/profile', 'ProfileController@index');
Route::get('/profile/edit', 'ProfileController@editProfile');
Route::get('/profile/edit/profile', 'ProfileController@editProfile');
Route::get('/profile/edit/account', 'ProfileController@editAccount');
Route::get('/{username}/{imagename}', 'ProfileController@showImage');
Route::get('/profile/{userid}', 'ProfileController@show');
Route::get('/{userid}', 'ProfileController@show');
Route::post('/profile/update', 'ProfileController@update');
Route::post('/user', 'UserController@update');

Auth::routes();
Route::get('/home', 'HomeController@index');
Auth::routes();
Route::get('/home', 'HomeController@index');
