@extends('layouts.app')

@php
    Log::debug('view: showビューです');
@endphp

@section('content')
    <div id="app">
        {{-- これで.vueファイルを読みこむことができる --}}
        {{-- これらpropsを使って、コンポーネントを流し込んでいる --}}
        <example-component title="{{__('Practice').'['.$drill->title.']'}}"
            :drill="{{$drill}}" category_name="{{$drill->category_name}}">
        </example-component>  
    </div>
@endsection



@php
    Log::debug('view: showビューの中のデータ: '.print_r($drill, true));
    Log::debug('view: showビューでpropsとしてjsに渡すやつ1: '.print_r($drill->title, true));
    Log::debug('view: showビューでpropsとしてjsに渡すやつ2: '.print_r($drill->category_name, true));
    Log::debug('view: showビュー終わりー');
@endphp

