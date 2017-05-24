<!doctype html>
<html>
<head>
    @section('header-js')
        <script src="/vendor/jquery/jquery.min.js"></script>
    @show

    @section('header-css')
        <link rel="stylesheet" href="/vendor/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="/vendor/jquery-ui/jquery-ui.min.css">

        <link rel="stylesheet" href="/css/custom.css">
        <link rel="stylesheet" href="/css/jumbotron-narrow.css">
    @show

</head>
<body>
@include('layouts.header')

<div class="container">
    <div class="whitebg jumbotron">
        @yield('content')
    </div>

    <footer class="footer">
        <p>&copy 2017</p>
    </footer>

</div>



@section('footer-js')
    <script src="/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script type="application/javascript" src="/vendor/jquery-ui/jquery-ui.min.js"></script>
@show
</body>
</html>