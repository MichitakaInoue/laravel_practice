<?php
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;


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
    return view('child');
});

Log::debug('Routing: ルーティング呼ばれました');  //ルーティングは一度に全部呼ばれるっぽい

//->nameでルーティングに対して名前がつけられ、viewのroute()の値(ヘルパーアクション)　便利関数　が引数に対応
 //Route()をviewに設定(ヘルパーアクション)することで　自動的にそのrouteのURLを生成してくれる
//そもそもnameをつけてviewのヘルパーに対応させるのは必須ではない。
//ルーティングのnameの中身と、ビューファイルの名前、ヘルパーアクションの名前、コントローラのアクション名は共通して考えないほうが良い


//drill新規追加メソッドにアクセス viewの
Route::get('/drills/new', 'DrillsController@new')->name('drills.new');


//URI drillsのDrillsControllerのcreateアクションを呼ぶ 
Route::post('/drills', 'DrillsController@create')->name('drills.create');

//練習登録一覧のルーティング
//drillsに対してgetできたとき、indexアクションに振り分ける
//
Route::get('/drills', 'DrillsController@index')->name('drills');

//各練習表示のルーティグ drillsにgetに来た時editアクションに振り分ける
Route::get('/drills/{id}/edit', 'DrillsController@edit')->name('drills.edit');


//練習更新用のルーティングに
Route::post('/drills/{id}', 'DrillsController@update')->name('drills.update');


//練習削除用のルーティング
//postで、指定したURIがきた時
Route::post('/drills/{id}/delete', 'DrillsController@destroy')->name('drills.delete');


//実際に練習をする画面のルーティング
Route::get('/drills/{id}', 'DrillsController@show')->name('drills.show');


//mypage(リレーション) 　mypageアクションに振り分ける
//middlewareを設定したのでactionの実行前の処理が走る
//注意！ログインしているかどうかはauthというmiddlewareが元から用意されていたので->middleware('auth')でもいい
Route::get('/mypage', 'DrillsController@mypage')->name('drills.mypage')->middleware('check');


// ルーティングが追加  laravelでの認証 vender/router/routingの中に書かれてるルーティングが読み込まれている
Auth::routes();


//URIがhomeのとき、コントローラー名@アクションの処理をしなさい　と言う意味
Route::get('/home', 'HomeController@index')->name('home');





