<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class AddUserIdToDrills extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('drills', function (Blueprint $table) {
            Schema::table('drills', function(Blueprint $table){
                DB::statement('DELETE FROM drills');//まず既存のテーブルデータを削除(statmentを使う)
                $table->unsignedBigInteger('user_id');//追加するカラム　型を指定
                $table->foreign('user_id')->references('id')->on('users');//外部キー(任意) foreignでカラムを指定 referencedでuser_idに紐づくものを指定　onでテーブル名を指定
            });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('drills', function (Blueprint $table) {
            Schema::table('drills', function(Blueprint $table){
                //外部キー付きのカラムを削除するにはまzu外部キー制約を外す必要がある
                $table->dropForeign(['user_id']);//配列の形式で外部キーを削除
                $table->dropColumn('user_id');//カラムを削除
            });
        });
    }
}
