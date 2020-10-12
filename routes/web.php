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

Route::get('/home', 'HomeController@index')->name('home');

//訪客身分使用第三方登入路由
Route::prefix('login')->group(function(){
    Route::get('{provider}', 'Auth\SocialController@redirect');
    Route::get('{provider}/callback', 'Auth\SocialController@callback');
});
