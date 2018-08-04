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

//菜品分类
Route::resource('menu_categories','Menu_categoryController');
//Route::get('menu_categories/{menu_category}/create','Menu_categoryController@create')->name('create.form');
//菜品
Route::resource('menus','MenuController');
//活动
Route::get('activities','ActivityController@index')->name('activities.index');
Route::get('activities/{activity}','ActivityController@show')->name('activities.show');
//订单
Route::resource('orders','OrderController');
//抽奖活动
Route::resource('events','EventController');
//查看抽奖结果
Route::get('event','EventController@check')->name('check');

//图片上传
Route::post('upload',function(){
    $storage = \Illuminate\Support\Facades\Storage::disk('oss');
    $filename = $storage->putFile('upload',request()->file('file'));
    return [
        'filename'=>$storage->url($filename),
    ];
})->name('upload');
