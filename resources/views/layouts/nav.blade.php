<nav class="navbar navbar-expand-md bg-dark navbar-dark">
    <a class="navbar-brand" href="{{ url('/') }}">
        <img src="{{ asset('img/diablocom.png') }}" alt="Das Logo von Diablocom">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="collapsibleNavbar">
        <ul class="navbar-nav">

            <li class="nav-item">
                <a class="nav-link" href="/">Startseite</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="/beitraege">Beiträge</a>
            </li>

            @if (Auth::guest())
            <li class="nav-item login_nav_item"><a href="{{ route('login') }}" class="nav-link login_nav">Login</a></li>
            @else
            <li class="dropdown">
                <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown" role="button" aria-expanded="false">
                    {{ Auth::user()->name }} <span class="caret"></span>
                </a>

                <ul class="dropdown-menu" role="menu">
                    <li>
                        <a href="{{ route('profile', Auth::user()) }}">Mein Profil</a>
                    </li>
                    <li>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            Logout
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <user-notifications></user-notifications>
            </li>
            @endif

        </ul>
    </div>
</nav>


