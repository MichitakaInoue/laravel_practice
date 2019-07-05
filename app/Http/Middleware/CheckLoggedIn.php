<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;

class CheckLoggedIn
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {   
        //action実行前に処理を行いたい
        if(!Auth::check()){
            return redirect('login');
        }
        return $next($request);
    }
}


//もしaction実行後 リクエスト処理後に何らかの処理をしたい場合はこっち
// public function handle($request, Closure $next)
//     {   
        // $response = $next($request);

//         if(!Auth::check()){
//             return redirect('login');
//         }

//         return $response;
//     }