
@extends('layouts.welcome') 

@section('title', 'マイページ')

@section('sidebar')
    @parent
    <p>メインのサイドバーに追加されるところ</p>
@endsection


@section('content')
    <p>メインコンテンツ</p>
    @include('common.error', ['text' => 'エラー'])
@endsection

@section('footer')
    @parent
    <script src="dashboard.js"></script>
@endsection


