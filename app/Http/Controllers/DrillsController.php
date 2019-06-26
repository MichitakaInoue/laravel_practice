<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Drill;  //名前空間を指定する
use Log;



class DrillsController extends Controller
{

    //練習内容一覧表示アクション
    public function index()
    {   
        Log::debug('Controller(Drills): 登録した練習表示用アクション。DBから値を取ってきます。');
        $drills = Drill::all(); //drillsテーブルの全レコードを表示する
        // Log::debug('$drillsの中身(取得した全部のデータ): '.print_r($drills, true));
        return view('drills.index', ['drills' => $drills]); //viewにそれを渡す　indexテンプレート(一覧表示用のビュー) 
        //指定したビューに対して値を指定するには第2にで配列の形式で '変数名‘=>'指定したい変数'　で 第１の名前をビュー側で変数名として使用することができる
        //compact('変数名')でも同じで便利
    }


    //練習登録画面を表示するnewアクション
    //php 7からnewが使える
    //名前はregist~~とかshow~~でもok
    public function new()
    {   
        Log::debug('Controller(Drills): 練習投稿画面(TOP)表示用アクション。画面を表示させます。 ');
        return view('drills.new'); //viewの中のdrillsに対応(newというテンプレート) に返している
    }

    public function create(Request $request)
    { //requiredは必須項目 |で区切ること  
        //string フィールドはタイプnullであることを許容する場合はそのフィールドでnullableを指定
        Log::debug('DrillController: 練習投稿用アクション。画面を表示させます。');

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


    //練習画面表示用アクション
    public function show($id){
        Log::debug('DrillController: 練習画面を実際に表示するためのアクションです');
        if(!ctype_digit($id)){
            return redirect('/drills/new')->with('flash_message', __('Invalid operation was performed.'));
        }
        //findでデータのIDを取ってきて、SQL文を発行して、
        //$drillの中にidが入ってくるので、ビュー側に発行してあげる
        $drill = Drill::find($id);
        return view('drills.show', ['drill' => $drill]);
    }




    //編集アクション
    public function edit($id)
    { //必須パラメータである　引数の変数名をRouteで指定するIDと同じパラメータ名にすることで自動的にそこにパラメタの値が入ってくる
        //パラメタは数値の見た目で入って来たとしても、全部文字列型として入ってくるのでGETパラメタが数値がどうかチェックする必要がある
        //GETパラメータが数字かどうかチェックする
        //事前にチェックしておくことでDBへの無駄なアクセスを減らすことができる

        //c
        //数値でなければsessionでエラーを表示させる
        Log::debug('DrillController: 各練習編集アクション。編集します'); 
        if (!ctype_digit($id)) {
            return redirect('/drills/new')->with('flash_message', __('Invalid operation was performed.'));
        }

        $drill = Drill::find($id); //modelのデータからidを取ってきて$drillの中に格納
        //取ってきたdrillをビュー側に格納 
        return view('drills.edit', ['drill' => $drill]);
    }


    //更新アクション  パラメータが入ってくるので
    //Requestクラス 変数, id
    public function update(Request $request, $id)
    {
        Log::debug('DrillController: 練習更新アクション。 練習を更新します。'); 
        //数値が判定
        if (!ctype_digit($id)) {
            return redirect('/drills/new')->with('flash_message', __('Invalid operation was performed.'));
        }
        $drill = Drill::find($id);  //new Drillだと新規登録
        $drill->fill($request->all())->save();  //fillで入力された値を詰めて、saveで更新
        return redirect('/drills')->with('flash_message', __('Registerd'));  //drillsにリダイレクトする
    }


    //削除アクション
    public function destroy($id){
        Log::debug('DrillController: 練習削除アクション。 練習を削除します'); 
        if(!ctype_digit($id)){
            return redirect('/drills/new')->with('flash_message', __('Invalid operation was performed'));
        }
        //削除するSQLを自動で作ってくれる
        Drill::find($id)->delete();
        //リファクタ
        // $drill = Drill::find($id);
        // $drill->delete();
        return redirect('/drills')->with('flash_message', __('Deleted.'));
    }
}




//これはDrillsコントローラーである
