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
                <li><a href="/blog"><i class="fa fa-sticky-note-o"></i> Blog</a></li>
                <li><a href="/contact"><i class="fa fa-coffee"></i> Contact</a></li>
                <li><a href="/about"><i class="fa fa-shield"></i> About</a></li>
                <li><a href="/tickets"><i class="fa fa-ticket"></i> Tickets</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-dropbox"></i> Dropdown
                        <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        @if (Auth::check())
                            @if(Auth::user()->hasRole('admin'))
                                <li><a href="/admin"><i class="fa fa-adn"></i> Admin</a></li>
                            @endif
                            <li><a href="users/logout"><i class="fa fa-laptop"></i> Logout</a></li>
                        @else
                            <li><a href="/users/register"><i class="fa fa-registered"></i> Register</a></li>
                            <li><a href="/users/login"><i class="fa fa-user"></i> Login</a></li>
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
        <a href="/" title="Home"><span class="glyphicon glyphicon-home"></span></a> &nbsp;
        <a href="/glcoas" title="General Ledger Trial Balance"><span class="glyphicon  glyphicon-th-list"></span></a> &nbsp;
        <a href="/gltrns" title="General Ledger"><span class="glyphicon glyphicon-th-large"></span></a> &nbsp;
        <a href="/glcoa/detail" title="General Ledger Detailed Statement"><span class="glyphicon  glyphicon-th"></span></a> &nbsp;
        <a href="/vendors" title="Vendors"><span class="glyphicon  glyphicon-briefcase"></span></a> &nbsp;
        <a href="/blog" title="Blog"><span class="glyphicon  glyphicon-list-alt"></span></a> &nbsp;
        <a href="/contact" title="Contact"><span class="glyphicon  glyphicon-pencil"></span></a> &nbsp;
        <a href="/about" title="About"><span style=color:{{Session::get('about')}} class="glyphicon glyphicon glyphicon-info-sign"></span></a> &nbsp;
        <a href="/tickets" title="Tickets"><span class="glyphicon  glyphicon-list"></span></a> &nbsp;
        <a href="/recipes" title="Recipes"><span class="glyphicons glyphicons-cutlery"></span></a> &nbsp;
        <a href="/customers" title="Customers"><span class="glyphicon glyphicon-user"></span></a> &nbsp;
        <a href="/trucks" title="Trucking Companies"><span class="glyphicon glyphicon-road"></span></a> &nbsp;
        <a href="/commodities" title="Commodities"><span class="glyphicon glyphicon-grain"></span></a> &nbsp;
        <a href="/inbounds" title="Inbound Tickets"><span class="glyphicon glyphicon-forward"></span></a> &nbsp;
        <a href="/outbounds" title="Outbound Tickets"><span class="glyphicon glyphicon-backward"></span></a> &nbsp;
        <a href="/dprs" title="Daily Position Records"><span class="glyphicon glyphicon-pause"></span></a> &nbsp;
        <a href="/mccs" title="Memphis Chess Club Members"><span class="glyphicon glyphicon-king"></span></a> &nbsp;
        <a href="/articles" title="Chess Games"><span class="glyphicon glyphicon-queen"></span></a> &nbsp;
        <a href="/articles/import" title="Imort Chess Games"><span class="glyphicon glyphicon-tower"></span></a> &nbsp;
        <a href="/quotes" title="Chess Quotes"><span class="glyphicon glyphicon-pawn"></span></a> &nbsp;
        <a href="/counties" title="Counties"><span class="glyphicons glyphicons-cogwheel"></span></a> &nbsp;
        <a href="/states" title="States"><span class="glyphicons glyphicons-cogwheels"></span></a> &nbsp;
        <a href="/zipcodes" title="Zipcodes"><span class="glyphicons glyphicons-send"></span></a> &nbsp;
        <a href="/logs" title="Logs"><span class="glyphicon glyphicon-book"></span></a> &nbsp;
        &nbsp;
    </div>
</div>
</p>