<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            {{-- <a class="navbar-brand" href="{{ url('/') }}" style="max-width: 30%;">
                {{ config('app.name', 'Laravel') }}
                <img src="/img/ama.png">
            </a> --}}
            <div class="logo-container">
                <div class="col-md-3 text-center">
                    <a href="/" class="logo-link" >
                        <img src="/img/ama.png">
                    </a>
                </div>
                <div class="col-md-9" style="margin-top:20px;">
                    <h3>AMA Computer College</h3>
                    <h4>Mandaluyong Campus</h4>
                    {{-- <h4>Online Faculty Evaluation</h4> --}}
                </div>
            </div>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                &nbsp;
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right" style="margin-top:25px">
                <!-- Authentication Links -->
                <li>
                    <a href="#"> {{ date('M d, Y g:i A')}}</a>
                </li>
                @guest
                    {{-- <li><a href="{{ route('login') }}">Login</a></li> --}}
                @else
                    {{-- @if(auth()->user()->user_type == 'admin')
                        <li><a href="{{ route('users.index') }}">Users</a></li>
                        <li><a href="{{ route('questions.index') }}">Questions</a></li>
                        <li><a href="{{ route('forms.index') }}">Forms</a></li>                        
                    @endif --}}
                    {{-- <li><a href="{{ route('users.index') }}">Questions</a></li> --}}
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
