<nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top text-white">
    <div class="container">
        <div class="navbar-wrapper">
            <a class="navbar-brand" href="{{ route('landing') }}"> {{ config('app.name') }}</a>
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index"
                aria-expanded="false" aria-label="Toggle navigation">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end">
            <ul class="navbar-nav">
                <li class="nav-item {{ Route::currentRouteName() == 'landing' ? 'active' : '' }}">
                    <a href="{{ route('landing') }}" class="nav-link">
                        <i class="material-icons">dashboard</i>
                        Home
                        <div class="ripple-container"></div>
                    </a>
                </li>
                @auth()
                <li class="nav-item {{ Route::currentRouteName() == 'register' ? 'active' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="material-icons">person</i>
                        {{ auth()->user()->username }}
                    </a>
                </li>
                    <li class="nav-item {{ Route::currentRouteName() == 'dashboard' ? 'active' : '' }}">
                        <a href="{{ route('dashboard') }}" class="nav-link">
                            <i class="material-icons">fingerprint</i>
                            Dashboard
                        </a>
                    </li>
                <li class="nav-item {{ Route::currentRouteName() == 'login' ? 'active' : '' }}">
                    <a href="{{ route('auth-logout') }}" class="nav-link">
                        <i class="material-icons">logout</i>
                        Logout
                    </a>
                </li>
                @endauth
                @guest()
                    <li class="nav-item {{ Route::currentRouteName() == 'register' ? 'active' : '' }}">
                        <a href="{{ route('register') }}" class="nav-link">
                            <i class="material-icons">person_add</i>
                            Register
                        </a>
                    </li>
                    <li class="nav-item {{ Route::currentRouteName() == 'login' ? 'active' : '' }}">
                        <a href="{{ route('login') }}" class="nav-link">
                            <i class="material-icons">fingerprint</i>
                            Login
                        </a>
                    </li>
                @endguest

            </ul>
        </div>
    </div>
</nav>
