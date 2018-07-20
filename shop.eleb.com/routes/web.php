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
Route::resource('shops','ShopController');
Route::resource('users','UserController');
//Route::get('users','UserController')->name('index');
Route::get('users/{user}/form','UserController@form')->name('users.form');
Route::patch('users/{user}reset/reset','UserController@reset')->name('users.reset');

//登录
Route::get('login', 'SessionController@login')->name('login');
Route::post('login', 'SessionController@store')->name('login');
Route::delete('logout', 'SessionController@destroy')->name('logout');
