<!-- 子テンプレート -->

<!-- 親のテンプレートを読みこんでいる -->
<!-- 親がまず全部読み込まれる -->
@extends('layouts.welcome') 

<!-- 子テンプレートでは@sectionの終わりは@show -->
@section('title', 'マイページ')

@section('sidebar')
    <!-- @parentで親テンプレートで指定したsidebarのタグがここに入ってくる  -->
    @parent
    <p>メインのサイドバーに追加されるところ</p>
@endsection

@section('content')
    <p>メインコンテンツ</p>
    <!-- @include(サブビュー)は継承ができず、デフォルト値の設定もできない -->
    <!-- テンプレートを読み込みたいだけだったり子テンプレートに値を渡したいだけのときに使う -->
    <!-- ただ値を渡すことができ、使う変数は配列　common.errorの$textに入ってくる -->
    @include('common.error' ['text' => 'エラー'])
@endsection

@section('footer')
    @parent
    <script src="dashboard.js"></script>
@endsection


<!-- このchildの方を表示させる -->


<!-- ルーティング -->
<!-- returnのURIを'child'にすることでlocalhost8000で表示できる -->