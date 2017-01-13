<nav class="navbar navbar-inverse navbar-static-top">
    <div class="container">
        <div class="navbar-header">

            {{-- Collapsed Hamburger --}}
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            {{-- Branding Image --}}
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel Podcast') }}
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">

            {{-- Left Side Of Navbar --}}
            <ul class="nav navbar-nav">
                @if (Auth::check())
                    <li class="{{ (Request::is('podcasts/manage') ? 'active' : '') }}"><a href="{{ url('/podcasts/manage') }}">Manage</a></li>
                    <li class="{{ (Request::is('podcasts/favorites') ? 'active' : '') }}"><a href="{{ url('/podcasts/favorites') }}">Favorites</a></li>
                    <li class="{{ ((Request::is('/') || Request::is('podcasts') || Request::is('podcasts/player')) ? 'active' : '') }}"><a href="{{ url('/podcasts/player') }}">Listen</a></li>
                    <li>
                        {!! Form::open(['url' => '/podcast/search', 'method' => 'get', 'class' => 'navbar-form', 'role' => 'search']) !!}
                            <div class="form-group">
                                {!! Form::text('query', null, ['class' => 'form-control', 'placeholder' => 'Search ...']) !!}
                            </div>
                        {!! Form::close() !!}
                    </li>
                @endif
            </ul>

            {{-- Right Side Of Navbar --}}
            <ul class="nav navbar-nav navbar-right">
                {{-- Authentication Links --}}
                @if (Auth::guest())
                    <li class="{{ (Request::is('login') ? 'active' : '') }}"><a href="{{ url('/login') }}">Login</a></li>
                    <li class="{{ (Request::is('register') ? 'active' : '') }}"><a href="{{ url('/register') }}">Register</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="{{ url('/logout') }}"
                                    onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>

    </div>
</nav>