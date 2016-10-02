<?php
Route::get('/', 'HomeController@index');
Route::get('/about', 'HomeController@about');
Route::get('/credits', 'HomeController@credits');

Route::get('/login', function (){ return view('login'); });
Route::get('/register', function (){ return view('register'); });

Route::post('/user/remove', 'UserController@remove');

Route::get('/images', 'ImageController@all');
Route::get('/images/all', 'ImageController@all');
Route::get('/images/upload', 'ImageController@upload');
Route::get('/images/result', 'ImageController@result');
Route::get('/images/category/{categoryname}', 'ImageController@category');
Route::get('/images/{imagename}', 'ImageController@show');
Route::get('/images/{imagename}/edit', 'ImageController@edit');
Route::get('/images/{imagename}/ratings', 'ImageController@ratings');
Route::get('/images/{imagename}/remove', 'ImageController@confirmRemove');
Route::post('images/remove', 'ImageController@remove');
Route::post('/images/edit', 'ImageController@update');
Route::post('/images/upload', 'ImageController@process');

Route::get('/profile/{username}/edit/profile', 'ProfileController@editProfile');
Route::get('/profile/{username}/edit/account', 'ProfileController@editAccount');
Route::get('/profile/{username}', 'ProfileController@show');
Route::post('/profile/update', 'ProfileController@update');

Route::get('/search/{images}', 'SearchController@show');
Route::post('/search', 'SearchController@search');

Route::post('/follow', 'FollowController@follow');
Route::post('/unfollow', 'FollowController@unfollow');

Route::post('/rate', 'RatingController@rate');

Route::post('/user/update', 'UserController@update');

Route::get('/admin', 'AdminController@index');

Route::get('/admin/categories', 'AdminController@categories');
Route::get('/admin/categories/add', 'AdminController@addCategory');
Route::get('/admin/categories/{categoryid}/edit', 'AdminController@editCategory');
Route::get('/admin/categories/{categoryid}/remove', 'AdminController@removeCategory');

Route::get('/admin/roles', 'AdminController@roles');
Route::get('/admin/roles/add', 'AdminController@addRole');
Route::get('/admin/roles/{roleid}/edit', 'AdminController@editRole');
Route::get('/admin/roles/{roleid}/remove', 'AdminController@removeRole');
Route::get('/admin/roles/{roleid}', 'AdminController@userRoles');

Route::get('/admin/users/{username}/remove', 'AdminController@removeUser');

Route::post('/admin/addCategory', 'CategoryController@add');
Route::post('/admin/updateCategory', 'CategoryController@editName');
Route::post('/admin/removeCategory', 'CategoryController@remove');

Route::post('/admin/addRole', 'RoleController@add');
Route::post('/admin/updateUserRole', 'RoleController@editName');
Route::post('/admin/removeRole', 'RoleController@remove');

Route::post('/admin/updaterole', 'UserController@updateRole');

// wildcard acting as a profile url !! always have as last route !!
Route::get('/{userid}', 'ProfileController@show');

Auth::routes();
Auth::routes();