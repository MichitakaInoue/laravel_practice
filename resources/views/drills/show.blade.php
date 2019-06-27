@extends('layouts.app')




@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    {{-- ここら辺で表示しているものはフロント側でいじりたいのでphp側のデータをフロント側に渡す必要がある --}}
                    <div class="card-header">
                        {{__('Practice').'['.$drill->title.']'}}
                    </div>
                    <div class="card-body text-center">
                        <p>{{$drill->problem0}}</p>
                        <p>{{$drill->problem1}}</p>
                        <p>{{$drill->problem2}}</p>

                        {{-- ここでVueを使っている --}}
                        <div id="app">
                            {{-- デフォルトだとこの中ではvue.jsが有効 --}}
                            {{-- example-componentはlaravelに入っているサンプルのコンポーネント --}}
                            {{-- laravel(php)の変数をvue(js)に渡す --}}
                            <example-component>
                                {{-- この中はbladeテンプレ(php)の書き方になる --}}
                                title="{{__('Practice').'['.$drill->title.']'}}"
                                {{-- 変数名の前に:をつけると全部が配列形式で渡すことができる --}}
                                :drill="{{$drill}}"
                            </example-component>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection