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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::prefix('users')->middleware('auth','role:user|admin')->group(function () {
    // Route User
    // Route::get('/', 'UserController@index')->name('users.index');
    Route::get('/profile', 'UserController@editProfile')->name('users.profile');
    Route::get('/edit/{id}', 'UserController@edit')->name('users.edit');
    Route::post('/update/{id}', 'UserController@update');
    Route::get('/edit_password', 'UserController@pagePassword')->name('users.password');
    Route::post('/change_password', 'UserController@ubahPassword');

    // Route user admin
    Route::get('/admin', 'Admins\UserController@index')->name('admins.user.index');
    Route::get('/admin/data-user/create', 'Admins\UserController@create')->name('admins.user.create');
    Route::post('/admin/data-user/', 'Admins\UserController@store')->name('admins.user.store');
    Route::get('/admin/data-user/{id}', 'Admins\UserController@show')->name('admins.user.show');
    Route::patch('/admin/data-user/{id}', 'Admins\UserController@update');
    Route::delete('/admin/data-user/{id}', 'Admins\UserController@destroy');

    // Route admin roles
    // Route::resource('/admins/role', Admins\RoleController::class);
    Route::get('/admin/role', 'Admins\RoleController@index')->name('admins.role.index');
    Route::get('/admin/role/create', 'Admins\RoleController@create')->name('admins.role.create');
    Route::get('/admin/role/{id}', 'Admins\RoleController@show')->name('admins.role.show');
    Route::post('/admin/role', 'Admins\RoleController@store');
    Route::patch('/admin/role/{id}', 'Admins\RoleController@update');
    Route::delete('/admin/role/{id}', 'Admins\RoleController@destroy');

    // Route admin permission
    // Route::resource('/admins/role', Admins\RoleController::class);
    Route::get('/admin/permission', 'Admins\PermissionController@index')->name('admins.permission.index');
    Route::get('/admin/permission/create', 'Admins\PermissionController@create')->name('admins.permission.create');
    Route::get('/admin/permission/{id}', 'Admins\PermissionController@show')->name('admins.permission.show');
    Route::post('/admin/permission', 'Admins\PermissionController@store');
    Route::patch('/admin/permission/{id}', 'Admins\PermissionController@update');
    Route::delete('/admin/permission/{id}', 'Admins\PermissionController@destroy');
    // Route::post('login', 'UserController@store');
});

Route::get('/home', 'HomeController@index')->middleware('auth')->name('home');
