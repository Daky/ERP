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

// Route::get('/', 'HomeController@index');
Route::get('/', function() {
    return redirect()->route('manage.users.list');
});

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

Route::get('manage/users', 'Manage\UserController@index')->name('manage.users.list');
Route::get('manage/users/create', 'Manage\UserController@create')->name('manage.users.create');
Route::post('manage/users/store', 'Manage\UserController@store')->name('manage.users.store');
Route::get('manage/users/show/{id}', 'Manage\UserController@show')->name('manage.users.show');
Route::get('manage/users/edit/{id}', 'Manage\UserController@edit')->name('manage.users.edit');
Route::post('manage/users/update', 'Manage\UserController@update')->name('manage.users.update');
Route::get('manage/users/disable/{id}', 'Manage\UserController@disable')->name('manage.users.disable');
