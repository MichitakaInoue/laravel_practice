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


// ルーティングが追加  laravelでの認証 vender/router/routingの中に書かれてるルーティングが読み込まれている
Auth::routes();

//URIがhomeのとき、コントローラー名@アクションの処理をしなさい　と言う意味
Route::get('/home', 'HomeController@index')->name('home');




