<?php
namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use Illuminate\Contacts\Auth\Guard;

 class UserComposer{
    protected $auth; //このクラスの中でしか使わないプロパティ

    public function __construct(Guard $auth){//引数の中に認証系のいろんな情報が入っている 
        //Guardは認証系のいろんな処理のはいったクラス authファサードと同じようなもの
        $this->auth = $auth;//初期化の時にauthを入れる
    }
    public function compose(View $view){ //その後にcomposeメソッドが実行される
        //composeメソッドでは引数にViewを取ってあげること
        //Viewのインスタンスが入ってくるのでwithメソッドがあるので
        //viewの方で使い回せるようにユーザー情報をviewに渡す処理
        //ビューに渡したい変数名を第１引数に入れる
        //userという変数を使えるようにしその中に$this->auth->user()と値を詰めてビューに渡す　Guardのuser()メソッドを使いユーザー情報を取得
        //$this->authには認証の情報が入っている
        $view->with('user', $this->auth->user());
    }
 }