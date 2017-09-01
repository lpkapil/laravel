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

Route::get('/dashboard', 'DashboardController@index')->name('index');

Route::resource('/dashboard/posts', 'PostController');
Route::resource('/dashboard/users', 'UserController');
Route::resource('/dashboard/roles', 'RoleController');
Route::resource('/dashboard/media', 'MediaController');
