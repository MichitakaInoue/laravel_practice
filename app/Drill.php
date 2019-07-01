<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

//これはモデル
//このクラス名の複数系をテーブル名として、自動的に判別してSQLを作って操作する  Drillsをテーブル名とする
class Drill extends Model //このModelクラスにDBを操作するメソッドが入っている 
{
    //DBで間違ったとしても変更させたくないカラム(ユーザーiD 、権限など)にはロックをかけておくことができる
        //同じユーザーでも、そこの権限が違うとかそういうカラムを作っている場合がある勝手に変更されると困るので、ロックをかけること
    //ロックのかけ方にはfillableもしくはgurdedの２つがある
    //どちらかしか指定はできず、
    //モデルがその属性以外を持たなくなる　

    //fillableの場合は変更したいカラムをどんどん書いていく
     //これらは変更していくべきところなので
     //DB操作で修正画面から更新させるなどで、fillメソッドを使うと更新が簡単 -->fillableを使うこと
    protected  $fillable = ['title', 'category_name', 'problem0', 'problem1', 'problem2', 'problem3', 'problem4',
    'problem5', 'problem6', 'problem7', 'problem8', 'problem9'];

    //これで、テーブル名はDrills　カラムを設定
    //このmodelを使って、DBの操作を行って行くのだがロックを


    //ここは変更されたくないもの テーブルなので運用していく中で考える
    // protected $gurded = ['id'];
}
