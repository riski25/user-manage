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
Route::prefix('users')->middleware('auth')->group(function () {
    Route::get('/', 'UserController@index')->name('users.index');
    Route::get('/profile', 'UserController@editProfile')->name('users.profile');
    Route::get('/edit/{id}', 'UserController@edit')->name('users.edit');
    Route::post('/update/{id}', 'UserController@update');
    Route::get('/edit_password', 'UserController@pagePassword')->name('users.password');
    Route::post('/change_password', 'UserController@ubahPassword');
    // Route::post('/', 'UserController@store');

    // Route::post('login', 'UserController@store');
});
Route::get('/home', 'HomeController@index')->name('home');
