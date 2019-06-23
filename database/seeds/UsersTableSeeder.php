<?php

use Illuminate\Database\Seeder;
use Illuminate\support\Facades\DB;  //DBクラス
use Carbon\Carbon; //carbon

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'test taro',
            'email'=> 'test@example.com',
            'password' => bcrypt('password'),  //必ずハッシュ化させること
            'created_at' => Carbon::now(), //Carbon::now()で現在日時
            'updated_at' => Carbon::now(),
        ]);
    }
}


//これはseeder
 //かりそめのデータを保存しておく場所
 