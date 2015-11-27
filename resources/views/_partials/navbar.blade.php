<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" date-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">{{ Config::get('constants.site.title') }}
                @if(isset($version))
                <span class="badge">{{ $version }}</span>
                @endif
            </a>
        </div>

        {{--Navbar Right--}}
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="/home"><i class="fa fa-home"></i> Home</a></li>
                <li><a href="/about"><i class="fa fa-shield"></i> About</a></li>
                @if(Auth::user())
                <li><a href="/admin"><i class="fa fa-adn"></i> Admin</a></li>
                @endif
                @if(!Auth::user())
                <li><a href="/register"><i class="fa fa-registered"></i> Register</a></li>
                @endif
                @if(!Auth::user())
                <li><a href="/login"><i class="fa fa-user"></i> Login</a></li>
                @endif
                @if(Auth::user())
                <li><a href="/logout"><i class="fa fa-laptop"></i> Logout</a></li>
                @endif
            </ul>
        </div>
    </div>
</nav>

{{Session::put('about', 'e6f9')}}
{{--{{Session::put('about', '#990000')}}--}}
{{--{{Session::put('about', '#000099')}}--}}

<p>
<div class="container">
    <div class="content">
        <a href="/" title="Home"><span class="glyphicon glyphicon-home"></span></a> &nbsp;
        <a href="/about" title="About"><span style="color:{{Session::get('about')}}" class="glyphicon glyphicon-info-sign"></span></a> &nbsp;
        <a href="/recipes" title="Recipes"><span class="glyphicons glyphicons-cutlery"></span></a> &nbsp;
        <a href="/logs" title="Logs"><span class="glyphicon glyphicon-book"></span></a> &nbsp;
        &nbsp;
    </div>
</div>
</p>