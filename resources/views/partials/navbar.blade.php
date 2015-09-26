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
            <a class="navbar-brand" href="#">{{ Config::get('constants.site.title') }}</a>
        </div>

        {{--Navbar Right--}}
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li class="active"><a href="/">Home</a></li>
                <li><a href="/blog">Blog</a></li>
                <li><a href="/contact">Contact</a></li>
                <li><a href="/about">About</a></li>
                <li><a href="/tickets">Tickets</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Dropdown
                        <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        @if (Auth::check())
                            @if(Auth::user()->hasRole('manager'))
                                <li><a href="/admin">Admin</a></li>
                            @endif
                            <li><a href="users/logout">Logout</a></li>
                        @else
                            <li><a href="/users/register">Register</a></li>
                            <li><a href="/users/login">Login</a></li>
                        @endif
                    </ul>
                </li>
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
        <a href="/" title="Home"><span class="glyphicon glyphicon glyphicon-home"></span></a> &nbsp;
        <a href="/blog" title="Blog"><span class="glyphicon glyphicon glyphicon glyphicon-list-alt"></span></a> &nbsp;
        <a href="/contact" title="Contact"><span class="glyphicon glyphicon glyphicon glyphicon-pencil"></span></a> &nbsp;
        <a href="/about" title="About"><span style=color:{{Session::get('about')}} class="glyphicon glyphicon glyphicon glyphicon-info-sign"></span></a> &nbsp;
        <a href="/tickets" title="Tickets"><span class="glyphicon glyphicon glyphicon glyphicon-list"></span></a> &nbsp;
        &nbsp;
    </div>
</div>
</p>