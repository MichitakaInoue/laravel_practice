<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //商用環境以外のときSQLログを出力させる
        //.envの app.envはlocal
        if(config('app.env') !== 'production'){
            DB::listen(function($query){//引数の$queryにクエリが実際に入ってくる 
                //$query->time　とか$query->sqlというプロパティが入ってくる
                Log::info("Query Time:{$query->time}s] $query->sql");
            });
        }
    }
}
