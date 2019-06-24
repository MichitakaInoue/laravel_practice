<!-- テンプレート(親) -->

<html>
<head>
    <!-- 親の()は子で何も指定しなかった時のデフォルト値 -->
    <!-- @yieldの場合継承ができないがデフォルト値は設定できる -->
    <title>Laravel | @yield('title', 'Home')</title>
</head>

<!-- 親は@sectionの場合は@show -->
<!-- sectionは継承ができる -->
@section('sidebar')
    <p>メインのサイドバー</p>
@show

<div id='container'>
    @yield('content')
</div>

@section('footer')
    <script src="app.js"></script>
@show
</html>