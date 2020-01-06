<nav class="navbar navbar-expand-lg navbar-light bg-nav">
        <a class="navbar-brand navlink" href="{{route('games.index')}}">BG!</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-between" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">

                <li class="nav-item active">
                    <a class="nav-link navlink" href="{{route('games.index')}}">{{__('Games')}} <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link navlink" href="{{route('players.index')}}">{{__('Players')}} <span class="sr-only">(current)</span></a>
                </li>
                @if(App\Battle_player::didIPlay(Auth::id()) == true)
                <li class="nav-item active">
                    <a class="nav-link navlink" href="{{route('battles.index')}}">{{__('Battles')}} <span class="sr-only">(current)</span></a>
                </li>
                @endif
                @if(App\Battle::inLobby(Auth::id()) == true)
                <li class="nav-item active">
                    <a class="nav-link navlink" href="{{route('battle_players.index')}}">{{__('Lobby')}}<span class="sr-only">(current)</span></a>
                </li>
                @endif
                @Auth
                @if(Auth::user()->role_id == 1)
                    <li class="nav-item active">
                        <a class="nav-link navlink" href="{{route('users.index')}}">{{__('Users')}}<span class="sr-only">(current)</span></a>
                    </li>
                @endif
                @endauth
            </ul>
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link navlink" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    <li class="nav-item">
                        @if (Route::has('register'))
                            <a class="nav-link navlink" href="{{ route('register') }}">{{ __('Register') }}</a>
                        @endif
                    </li>
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link navlink dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->player()->first()->nickname}} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right dropdownnav" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item navlink" href="{{route('players.show', Auth::id())}}">{{__('Profile')}}</a>
                            <a class="dropdown-item navlink" href="{{route('players.edit', Auth::id())}}">{{__('Player settings')}}</a>
                            <a class="dropdown-item navlink" href="{{route('users.edit', Auth::id())}}">{{__('Account settings')}}</a>
                            <a class="dropdown-item navlink" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('players.statusOffline') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </nav>