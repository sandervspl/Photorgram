<?php
use Illuminate\Support\Facades\Config;

$roles = [
    'user' => Config::get('constants.roles.user'),
    'developer' => Config::get('constants.roles.developer'),
    'moderator' => Config::get('constants.roles.moderator'),
    'administrator' => Config::get('constants.roles.administrator'),
];

Route::get('/', 'HomeController@index');
Route::get('/about', 'HomeController@about');
Route::get('/credits', 'HomeController@credits');

Route::get('/login', function (){ return view('login'); });
Route::get('/register', function (){ return view('register'); });

Route::get('/images', 'ImageController@allImages');
Route::get('/images/all', 'ImageController@allImages');
Route::get('/images/upload', 'ImageController@upload');
Route::get('/images/result', 'ImageController@result');
Route::get('/images/category/{categoryname}', 'ImageController@category');
Route::get('/images/{imagename}', 'ImageController@show');
Route::get('/images/{imagename}/edit', 'ImageController@edit');
Route::get('/images/{imagename}/ratings', 'ImageController@ratings');
Route::get('/images/{imagename}/likes', 'ImageController@likesOverview');
Route::get('/images/{imagename}/dislikes', 'ImageController@dislikesOverview');
Route::get('/images/{imagename}/remove', 'ImageController@confirmRemove');
Route::post('images/remove', 'ImageController@remove');
Route::post('/images/edit', 'ImageController@update');
Route::post('/images/upload', 'ImageController@process');

Route::get('/profile/{username}/followers', 'ProfileController@followers');
Route::get('/profile/{username}/following', 'ProfileController@following');
Route::get('/profile/{username}/edit/profile', 'ProfileController@editProfile');
Route::get('/profile/{username}/edit/account', 'ProfileController@editAccount');
Route::get('/profile/{username}', 'ProfileController@show');
Route::post('/profile/update', 'ProfileController@update');

Route::get('/search/profiles/{query}', 'SearchController@showProfiles');
Route::get('/search/images/{query}', 'SearchController@showImages');
Route::get('/search/categories/{query}', 'SearchController@showCategories');
Route::post('/search', 'SearchController@search');

Route::post('/follow', 'FollowController@follow')->name('follow');
Route::post('/unfollow', 'FollowController@unfollow')->name('unfollow');

Route::get('/rate/{rating_id}/remove', 'RatingController@remove');
Route::post('/rate', 'RatingController@rate')->name('rate');

Route::post('/user/update', 'UserController@update');

/*
 *      ADMIN PAGE
 */
Route::get('/admin', [
    'uses' => 'AdminController@index',
    'middleware' => 'roles',
    'roles' => [
        $roles['moderator'],
        $roles['administrator']
    ]
]);



/*
 *      ADMIN USERS PAGE
 */
Route::get('/admin/users/{username}/remove', [
    'uses' => 'AdminController@removeUser',
    'middleware' => 'roles',
    'roles' => [$roles['administrator']]
]);
Route::post('/user/remove', [
    'uses' => 'UserController@remove',
    'middleware' => 'roles',
    'roles' => [$roles['administrator']]
]);

Route::get('/admin/search/users/{query}', [
    'uses' => 'AdminController@searchShowUsers',
    'middleware' => 'roles',
    'roles' => [$roles['moderator'], $roles['administrator']]
]);
Route::post('/admin/search/users', [
    'uses' => 'SearchController@adminSearchUsers',
    'middleware' => 'roles',
    'roles' => [$roles['moderator'], $roles['administrator']]
]);

Route::get('/admin/search/categories/{query}', [
    'uses' => 'AdminController@searchShowCategories',
    'middleware' => 'roles',
    'roles' => [$roles['moderator'], $roles['administrator']]
]);
Route::post('/admin/search/categories', [
    'uses' => 'SearchController@adminSearchCategories',
    'middleware' => 'roles',
    'roles' => [$roles['moderator'], $roles['administrator']]
]);

/*
 *      ADMIN CATEGORIES PAGES
 */
Route::get('/admin/categories', [
    'uses' => 'AdminController@categories',
    'middleware' => 'roles',
    'roles' => [
        $roles['moderator'],
        $roles['administrator']
    ]
]);
Route::get('/admin/categories/add', [
    'uses' => 'AdminController@addCategory',
    'middleware' => 'roles',
    'roles' => [
        $roles['moderator'],
        $roles['administrator']
    ]
]);
Route::get('/admin/categories/{categoryid}/edit', [
    'uses' => 'AdminController@editCategory',
    'middleware' => 'roles',
    'roles' => [
        $roles['moderator'],
        $roles['administrator']
    ]
]);
Route::get('/admin/categories/{categoryid}/remove', [
    'uses' =>'AdminController@removeCategory',
    'middleware' => 'roles',
    'roles' => [
        $roles['moderator'],
        $roles['administrator']
    ]
]);


/*
 *      ADMIN ROLES PAGES
 */
Route::get('/admin/roles', [
    'uses' =>'AdminController@roles',
    'middleware' => 'roles',
    'roles' => [
        $roles['moderator'],
        $roles['administrator']
    ]
]);
Route::get('/admin/roles/add', [
    'uses' => 'AdminController@addRole',
    'middleware' => 'roles',
    'roles' => [
        $roles['moderator'],
        $roles['administrator']
    ]
]);
Route::get('/admin/roles/{roleid}/edit', [
    'uses' => 'AdminController@editRole',
    'middleware' => 'roles',
    'roles' => [
        $roles['moderator'],
        $roles['administrator']
    ]
]);
Route::get('/admin/roles/{roleid}/remove', [
    'uses' => 'AdminController@removeRole',
    'middleware' => 'roles',
    'roles' => [
        $roles['moderator'],
        $roles['administrator']
    ]
]);
Route::get('/admin/roles/{roleid}', [
    'uses' => 'AdminController@userRoles',
    'middleware' => 'roles',
    'roles' => [
        $roles['moderator'],
        $roles['administrator']
    ]
]);


/*
 *      ADMIN CATEGORY REQUESTS
 */
Route::post('/admin/addCategory', [
    'uses' => 'CategoryController@add',
    'middleware' => 'roles',
    'roles' => [
        $roles['moderator'],
        $roles['administrator']
    ]
]);
Route::post('/admin/updateCategory', [
    'uses' => 'CategoryController@editName',
    'middleware' => 'roles',
    'roles' => [
        $roles['moderator'],
        $roles['administrator']
    ]
]);
Route::post('/admin/removeCategory', [
    'uses' => 'CategoryController@remove',
    'middleware' => 'roles',
    'roles' => [
        $roles['moderator'],
        $roles['administrator']
    ]
]);


/*
 *      ADMIN ROLES REQUESTS
 */
Route::post('/admin/addRole', [
    'uses' => 'RoleController@add',
    'middleware' => 'roles',
    'roles' => [
        $roles['moderator'],
        $roles['administrator']
    ]
]);
Route::post('/admin/updateUserRole', [
    'uses' => 'RoleController@editName',
    'middleware' => 'roles',
    'roles' => [
        $roles['moderator'],
        $roles['administrator']
    ]
]);
Route::post('/admin/removeRole', [
    'uses' => 'RoleController@remove',
    'middleware' => 'roles',
    'roles' => [
        $roles['moderator'],
        $roles['administrator']
    ]
]);
Route::post('/admin/updaterole', [
    'uses' => 'UserController@updateRole',
    'middleware' => 'roles',
    'roles' => [
        $roles['moderator'],
        $roles['administrator']
    ]
])->name('updateRole');

// wildcard acting as a profile url !! always have as last route !!
Route::get('/{userid}', 'ProfileController@show');

Auth::routes();
Auth::routes();