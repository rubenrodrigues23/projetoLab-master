<nav class="navbar navbar-expand-md navbar-light navbar-laravel">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/admin/home') }}">
            CyberStore
        </a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a href="{{url('/about')}}" class="nav-link">About</a>
                </li>
            </ul>
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    @guest
                    @if (Route::has('login'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @endif

                @if (Route::has('register'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                </li>
                @endif
                @else
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a href="{{url('/adverts')}}" class="nav-link">Adverts</a>
                    </li>
                </ul>
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{url('/logout')}}" onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">Logout
                        </a>
                        <a class="dropdown-item" href="{{url('/adverts/create')}}" class="nav-link">Create an Advert
                        </a>
                        <a class="dropdown-item" href="{{url('/adverts/myAdverts')}}" class="nav-link">My Adverts
                        </a>
                        <a class="dropdown-item" href="{{ url('/chatify') }}" class="nav-link">Chat
                        </a>
                        <form id="logout-form" action="/logout" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
                @endguest
                </li>
            </ul>
        </div>
    </div>
</nav>