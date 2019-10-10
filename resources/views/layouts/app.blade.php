<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <script type="text/javascript">
        var onloadCallback = function() {
          grecaptcha.render(document.getElementById('reCaptcha'), {
            'sitekey' : '6Ld607wUAAAAAL4ESOGNDiwiWbtr1aWaHyl11gQZ',
          });
        };
      </script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-sm navbar-dark bg-primary shadow mb-5">
            <div class="container-fluid">
                <img src="/post-it.svg" class="mr-3" height="30px" width="30px" alt="logo"/>
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item {{ Route::is('login') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Connexion') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item {{ Route::is('register') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Inscription') }}</a>
                                </li>
                            @endif
                        @else
                            <!-- For normal size screens, show user icon -->
                            <li class="nav-item dropdown dropdown-menu-right d-none d-sm-block">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                @if(auth()->user()->avatar)
                                    <img src="{{ auth()->user()->avatar }}" class="rounded-circle" alt="avatar" width="32" height="32" style="margin-right: 8px;">
                                @else
                                <i class="material-icons md-48" style="color:white" style="margin-right: 8px;">
                                    account_circle
                                </i>
                                @endif
                            </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                    <span class="dropdown-header" >
                                        {{ auth()->user()->name }}
                                    </span>
                                    <a class="dropdown-item {{Route::is('conversation.index') ? 'active' : '' }}" href="{{ route('conversation.index') }}">
                                        {{ __('Démarrer une conversation') }}
                                    </a>
                                    <a class="dropdown-item {{Route::is('conversation.list') ? 'active' : ''}}" href="{{ route('conversation.list') }}">
                                        {{ __('Mes conversations') }}
                                    </a>
                                    <hr>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Déconnexion') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>

                            <!-- For small (xs) screens, show only links -->
                            <div class="d-block d-sm-none">
                                <li class="nav-item">
                                    <span class="text-white" >
                                        {{ auth()->user()->name }}
                                    </span>
                                </li>
                                <li class="nav-item d-block d-sm-none">
                                    <a class="nav-link {{ Route::is('conversation.index') ? 'active' : '' }}" href="{{ route('conversation.index') }}">{{ __('Démarrer une conversation') }}</a>
                                </li>
                                <li class="nav-item d-block d-sm-none">
                                    <a class="nav-link {{Route::is('conversation.list') ? 'active' : ''}}" href="{{ route('conversation.list') }}">{{ __('Mes conversations') }}</a>
                                </li>
                                <li class="nav-item d-block d-sm-none">
                                    <a class="nav-link" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                            {{ __('Déconnexion') }}</a>
                                </li>
                            </div>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
<!-- Scripts -->
<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit"
async defer>
</script>
<script src="{{ asset('js/app.js') }}"></script>

</html>
