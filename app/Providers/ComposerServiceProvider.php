<?php

namespace App\Providers;

use App\Http\ViewComposers\UserComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {   
        //ユーザーコンポーザーを渡す
        //連想配列で渡すこと
        //キーにコンポーザーを指定し、値にビューを指定
        //どのテンプレートに適用したいかワイルドカードという*で、layouts配下全てでUserComposerを読みこむ $userが作られる
        View::composers([
            UserComposer::class    => 'layouts.*'
        ]);
    }
}
