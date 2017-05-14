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

Route::group(['middleware' => ['auth']], function () {
    Route::get('/', function() {
    	return redirect()->route('manage.users.list');
    });
});

// Route::get('/', 'HomeController@index');
// Route::get('/', function() {
//     return redirect()->route('manage.users.list');
// });

// Authentication Routes...
Route::get('login', 'Auth\ERPLoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\ERPLoginController@login');
Route::get('logout', 'Auth\ERPLoginController@logout')->name('logout');

// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

//users
Route::get('manage/users', 'Manage\UserController@index')->name('manage.users.list');
Route::get('manage/users/create', 'Manage\UserController@create')->name('manage.users.create');
Route::post('manage/users/store', 'Manage\UserController@store')->name('manage.users.store');
Route::get('manage/users/show/{id}', 'Manage\UserController@show')->name('manage.users.show');
Route::get('manage/users/edit/{id}', 'Manage\UserController@edit')->name('manage.users.edit');
Route::post('manage/users/update', 'Manage\UserController@update')->name('manage.users.update');
Route::get('manage/users/disable/{id}', 'Manage\UserController@disable')->name('manage.users.disable');

//roles
Route::get('manage/roles', 'Manage\RoleController@index')->name('manage.roles.list');
Route::get('manage/roles/create', 'Manage\RoleController@create')->name('manage.roles.create');
Route::post('manage/roles/store', 'Manage\RoleController@store')->name('manage.roles.store');
Route::get('manage/roles/show/{id}', 'Manage\RoleController@show')->name('manage.roles.show');
Route::get('manage/roles/edit/{id}', 'Manage\RoleController@edit')->name('manage.roles.edit');
Route::post('manage/roles/update', 'Manage\RoleController@update')->name('manage.roles.update');
Route::get('manage/roles/destroy/{id}', 'Manage\RoleController@destroy')->name('manage.roles.destroy');

//permissions
Route::get('manage/permissions', 'Manage\PermissionController@index')->name('manage.permissions.list');
Route::get('manage/permissions/create', 'Manage\PermissionController@create')->name('manage.permissions.create');
Route::post('manage/permissions/store', 'Manage\PermissionController@store')->name('manage.permissions.store');
Route::get('manage/permissions/show/{id}', 'Manage\PermissionController@show')->name('manage.permissions.show');
Route::get('manage/permissions/edit/{id}', 'Manage\PermissionController@edit')->name('manage.permissions.edit');
Route::post('manage/permissions/update', 'Manage\PermissionController@update')->name('manage.permissions.update');
Route::get('manage/permissions/destroy/{id}', 'Manage\PermissionController@destroy')->name('manage.permissions.destroy');

//derbou - humanefficiency
Route::get('derbou/humanefficiency', 'Derbou\HumanEfficiencyController@index')->name('derbou.humanefficiency.list');
