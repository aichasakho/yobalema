<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
        <a class="navbar-brand" href="{{ route('index') }}">Yoba<span>lema</span></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> Menu
        </button>

        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">

                <li class="active"><a href="{{ route('index') }}" class="nav-link">Home</a></li>
                @if(Route::has('location.client'))
                    <li>
                        <a href="{{ route('location.client') }}" class="nav-link">
                            Mes Locations
                        </a>
                    </li>
                @endif

                <li class="nav-item active"><a href="index.html" class="nav-link">Accueil</a></li>
                <li class="nav-item"><a href="about.html" class="nav-link">Locations</a></li>
                <li class="nav-item"><a href="services.html" class="nav-link">Chauffeurs</a></li>
                <li class="nav-item"><a href="car.html" class="nav-link">Voitures</a></li>
                <li class="nav-item"><a href="{{ route('dashboard') }}" class="nav-link">Dashboard</a></li>

                @guest

                    <li>
                        <a href="{{ route('login') }}" class="nav-link">Se Connecter</a>
                    </li>

                    <li>
                        <a href="{{ route('register') }}" class="nav-link">S'inscrire</a>
                    </li>

                @endguest
                @auth

                    @if(Auth::user()->role_user_id == 1 && Route::has('admin.dashboard'))
                        <li>
                            <a href="{{ route('admin.dashboard') }}" class="nav-link">
                                {{ __('Dashboard') }}
                            </a>
                        </li>
                    @endif

                    @if(Route::has('client.profil'))
                        <li>
                            <a href="{{ route('client.profil') }}" class="nav-link">Login</a>
                        </li>
                    @endif

                    <form action="{{ route('logout') }}" method="post" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-outline-primary  mx-3 d-inline"
                                onclick="event.preventDefault();
                                    this.closest('form').submit();">
                            {{ __('Se Déconnecter') }}
                        </button>
                    </form>
                @endauth

            </ul>
        </div>
    </div>
</nav>
