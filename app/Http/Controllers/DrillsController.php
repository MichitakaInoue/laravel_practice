<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Drill;  //名前空間を指定する

class DrillsController extends Controller
{
    //練習登録画面を表示するnewアクション
    //php 7からnewが使える
    //名前はregist~~とかshow~~でもok
    public function new()
    {
        return view('drills.new'); //viewの中のdrillsに対応(newというテンプレート)
    }

    public function create(Request $request)
    { //requiredは必須項目 |で区切ること  
      //string フィールドはタイプnullであることを許容する場合はそのフィールドでnullableを指定

        $request->validate([
            'title' => 'required|string|max:255',
            'category_name' => 'required|string|max:255',
            'problem0' => 'required|string|max:255',
            'problem1' => 'string|nullable|max:255',
            'problem2' => 'string|nullable|max:255',
            'problem3' => 'string|nullable|max:255',
            'problem4' => 'string|nullable|max:255',
            'problem5' => 'string|nullable|max:255',
            'problem6' => 'string|nullable|max:255',
            'problem7' => 'string|nullable|max:255',
            'problem8' => 'string|nullable|max:255',
            'problem9' => 'string|nullable|max:255',
        ]);


        //実際にDBに保存 モデルを呼び出す　
        //DrillモデルはModelクラスを拡張するもので、DB操作のためのメソッドが入っている
        $drill = new Drill;



        //1つ１つ入れるか
        // $drill->title = $request->title;
        // $drill->category_name = $request->category_name;
        // $drill->save();




        //fillを使って一気に入れるか
        //$fillabeleを使っていないと変なデータが入り込んだ場合に勝手にDBが更新されてしまうので注意すること

        //Drillモデルにはfillメソッドが入っている
        //fillの引数として、更新したいものを全部入れること allメソッドを使う
        //それを元にsaveメソッドを呼ぶことでDBが更新される  レコードに手を加えるときに使うもの 
        //saveを呼ぶだけで、更新なのか挿入なのか削除なのか自動で判断してSQLを作ってDBに問い合わせる

        //例えば、レコードがすでに入っていた場合には、更新と判断する。
        //しかし、本来ならば更新されたくない値も入ってしまうことになるので、modelで定義した$fillableで変更したいものだけ指定すれば
        //$fillableで指定されていないものは更新されない



        //ここでSQLのエラーがあった場合には  try catchを自動的にやってくれる
        //エラーメッセージを個別に表示させる処理も書くことができる
        $drill->fill($request->all())->save();




        //登録の処理が終わったのでリダイレクト
        //withメソッドを使うことでsessionに値を詰めることができる
        //第１session変数の名前   第２引数にメッセージを入れる　　アンスコ２つで
        //このメッセージはビューに渡す(当たり前)
        return redirect('/drills/new')->with('flash_message', __('Registerd'));


    

    }
}




//これはDrillsコントローラーである