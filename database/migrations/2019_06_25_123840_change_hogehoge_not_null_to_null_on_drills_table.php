<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeHogehogeNotNullToNullOnDrillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('drills', function (Blueprint $table) {

            //problem0は必須項目なのでnotNull制約はつけた方がいい
            //これでnullを変更するというSQLを発行することができる
            $table->string('problem1')->nullable()->change();
            $table->string('problem2')->nullable()->change();
            $table->string('problem3')->nullable()->change();
            $table->string('problem4')->nullable()->change();
            $table->string('problem5')->nullable()->change();
            $table->string('problem6')->nullable()->change();
            $table->string('problem7')->nullable()->change();
            $table->string('problem8')->nullable()->change();
            $table->string('problem9')->nullable()->change();

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
            //upを取り消す処理  引数としてfasleになっている
            //$table->string(型指定)  バーキャラになることに注意
            $table->string('problem1')->nullable(false)->change();
            $table->string('problem2')->nullable(false)->change();
            $table->string('problem3')->nullable(false)->change();
            $table->string('problem4')->nullable(false)->change();
            $table->string('problem5')->nullable(false)->change();
            $table->string('problem6')->nullable(false)->change();
            $table->string('problem7')->nullable(false)->change();
            $table->string('problem8')->nullable(false)->change();
            $table->string('problem9')->nullable(false)->change();
        });
    }
}
