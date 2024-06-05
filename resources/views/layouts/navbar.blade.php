<nav class="navbar navbar-expand-lg bg-dark border-bottom border-bottom-dark ticky-top bg-body-tertiary"
     data-bs-theme="dark">
    <div class="container">
        <a class="navbar-brand fw-light" href="{{ route('dashboard') }}"><span class="fas fa-brain me-1"> </span>{{ config('app.name') }}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="languageDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ App::getLocale() }}
                        <span class="visually-hidden">Language</span>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="languageDropdown">
                        <li><a class="dropdown-item" href="{{ route('lang', 'en') }}">English</a></li>
                        <li><a class="dropdown-item" href="{{ route('lang', 'fr') }}">French</a></li>
                        <li><a class="dropdown-item" href="{{ route('lang', 'es') }}">Spanish</a></li>
                    </ul>
                </li>
                @guest()
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('login') ? 'active' : ''}}" aria-current="page" href="/login">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('register') ? 'active' : ''}}" href="/register">Register</a>
                    </li>
                @endguest
                @auth()
                    @if (auth()->user()->is_admin)
                        <li class="nav-item">
                            <a class="nav-link" href=" {{ route('admin.dashboard.index') }} "> Admin Dashboard </a>
                        </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link" href=" {{ route('profile') }} "> {{auth()->user()->name}} </a>
                    </li>
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="btn btn-danger" type="submit">Logout</button>
                        </form>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
