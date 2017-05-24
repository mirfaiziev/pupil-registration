<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">

            <a class="navbar-brand" href="{{route('home')}}">Регистрация участников</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">

            <div class="pull-right" style="padding-top: 15px">
                @if (Auth::check())
                    <div>Здравствуйте, {{Auth::user()->name}}. <a href="{{route('logout')}}">Logout</a></div>
                @else
                    <div><a href="{{route('login')}}">Login</a></div>
                @endif
            </div>
        </div><!--/.nav-collapse -->
    </div>
</nav>
