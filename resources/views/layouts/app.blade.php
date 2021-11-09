<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/home') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    {{-- {{ dd(auth()->user()->hasPermissionTo('admins.index'))}} --}}
                    @if (!auth()->user())

                    @else
                        {{-- auth()->user()->can('admins.index') --}}
                        @role('admin')

                            @if (auth()->user()->hasPermissionTo('admins.index'))
                            <ul class="navbar-nav mr-auto">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('admins.user.index') }}">User</a>
                                </li>
                            @endif
                            {{-- <ul class="navbar-nav mr-auto"> --}}
                                <li class="nav-item dropdown">
                                    <a id="" class="nav-link dropdown-toggle" href="" role="button" data-toggle="dropdown" data-target="navbarSettingAccess" aria-haspopup="true" aria-expanded="false" v-pre>
                                        Setting Access <span class="caret"></span>
                                    </a>

                                    <ul class="dropdown-menu" id="navbarSettingAccess" aria-labelledby="navbarSettingAccess">
                                        @if (auth()->user()->can('admins.role.index','admins.role.show'))
                                            <a class="dropdown-item" href="{{route('admins.role.index')}}">
                                                Roles
                                            </a>
                                        @endif

                                        @if (auth()->user()->can('admins.permission.index','admins.permission.show'))
                                        {{-- <li class="dropdown-submenu"> --}}
                                            <a href="{{route('admins.permission.index')}}" class="dropdown-item">
                                                <span class="nav-label">Permmissions</span><span class="caret"></span>
                                            </a>
                                        {{-- </li> --}}
                                        @endif
                                            {{-- <a class="dropdown-item" href="{{route('admins.permission.index')}}">
                                                Permmissions
                                            </a> --}}
                                    </ul>
                                </li>
                            </ul>
                        @endrole
                    @endif

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ url('users/edit/'.Auth()->id()) }}">
                                        Profile
                                    </a>
                                    <a class="dropdown-item" href="{{ route('users.password') }}">
                                        Update Password
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
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
</html>
