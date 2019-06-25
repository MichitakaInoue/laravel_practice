

<html>
<head>
    <title>Laravel | @yield('title', 'Home')</title>
</head>


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