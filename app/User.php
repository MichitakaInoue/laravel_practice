<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //リレーション
    public function drills(){//基本的にメソッド名紐付けたいモデルの複数系にすること drillsテーブルからも複数レコードをとってくる
        //なにをやっているか 
        //Userモデルに対してdrillというモデルがひもづく、ということを定義してあげる
        //デフォルトのhasManyというメソッドを作ってあげる引数にAppからの名前空間
        //1対多の関係をuser視点から見た場合の考え。userはたくさんのdrill(つまりdrillsを持っているということ)
        return  $this->hasMany('App\Drill');
    }
}
