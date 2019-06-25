<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


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

        $request->validate([
            'title' => 'required|string|max:255',
            'category_name' => 'required|string|max:255',
            'problem0' => 'required|string|max:255',
            'problem1' => 'required|string|max:255',
            'problem2' => 'required|string|max:255',
            'problem3' => 'required|string|max:255',
            'problem4' => 'required|string|max:255',
            'problem5' => 'required|string|max:255',
            'problem6' => 'required|string|max:255',
            'problem7' => 'required|string|max:255',
            'problem8' => 'required|string|max:255',
            'problem9' => 'required|string|max:255',
        ]);
    }
}



//Drillsコントローラー
