<?php
Route::get('/', function (){ return view('index'); });

Route::get('/login', function (){ return view('login'); });
Route::get('/register', function (){ return view('register'); });

Route::get('/images', 'ImageController@all');
Route::get('/images/all', 'ImageController@all');
Route::get('/images/upload', 'ImageController@upload');
Route::get('/images/result', 'ImageController@result');
Route::get('/images/category/{categoryname}', 'ImageController@category');
Route::get('/images/{imagename}', 'ImageController@show');
Route::get('/images/{imagename}/edit', 'ImageController@edit');
Route::get('/images/{imagename}/ratings', 'ImageController@ratings');
Route::post('/images/edit', 'ImageController@update');
Route::post('/images/upload', 'ImageController@process');

Route::get('/profile', 'ProfileController@index');
Route::get('/profile/edit', 'ProfileController@editProfile');
Route::get('/profile/edit/profile', 'ProfileController@editProfile');
Route::get('/profile/edit/account', 'ProfileController@editAccount');
Route::get('/profile/{userid}', 'ProfileController@show');
Route::get('/{userid}', 'ProfileController@show');
Route::post('/profile/update', 'ProfileController@update');

Route::get('/search/{images}', 'SearchController@show');
Route::post('/search', 'SearchController@search');

Route::post('/follow', 'FollowController@follow');
Route::post('/unfollow', 'FollowController@unfollow');

Route::post('/rate', 'RatingController@rate');

Route::post('/user/update', 'UserController@update');

Auth::routes();
Auth::routes();