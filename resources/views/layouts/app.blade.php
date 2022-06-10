<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
{{--    <script src="{{ asset('js/app.js') }}" defer></script>--}}
    <!--    jqury-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js" ></script>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">    <!--мой JS-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">

    <script  src="{{ asset('js/script.js') }}"></script>
    <script  src="{{asset('js/tableScript.js')}}"></script>
    <link rel="shortcut icon"  type="image/x-icon">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Bad+Script&family=Caveat:wght@400;500;600;700&family=Neucha&display=swap');
    </style>


    <!-- Styles -->
{{--    <link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}
<!--мой CSS-->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body >
    <div id="app">
        <nav class="navbar navbar-expand-md  navbar-dark shadow-sm sticky-top"  style="background: linear-gradient(180deg, rgba(0, 0, 0, 0.5) 0%, rgba(0, 0, 0, 0.9) 50%);;filter: drop-shadow(0px -25px 30px #00FFFA);">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{asset('favicon.ico')}}" alt="" height="24" class="d-inline-block align-text-top">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="/">Главная</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/create">Создать схему</a>
                        </li>

                        @auth
                        <li class="nav-item">
                        <a class="nav-link" href="/profile/{{ Auth::user()->name }}">Ваши схемы</a>
                        </li>

                        @endauth
                        <li class="nav-item">
                            <a class="nav-link" href="/search/last">{{__('Search')}}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="https://forms.gle/HM8v4NR4kS5DLiWw5"  target="_blank">Оставить отзыв</a>
                        </li>
                        <li>
                            <br>{{-- разрыв для правого меню в мобильном режме--}}
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login')}} </a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register')}}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{route('favorites')}}">Избранные</a>

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>


                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <div class="alertsContainer sticky-top">
            {{--генерация исключений--}}
            @if ($errors->any())
{{--                <div class="alert alert-danger alert-dismissible fade show" role="alert">--}}
{{--                    <ul>--}}
            <script defer>
                        @foreach ($errors->all() as $error)
                    console.log({{ $error }})
                        @endforeach
{{--                    </ul>--}}
            </script>
{{--                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>--}}
{{--                </div>--}}
            @endif

        @isset($alerts['message'])
            @for($i=0;$i<count($alerts['message']);$i++ )
                <div class="alert alert-{{$alerts['type'][$i]}} alert-dismissible fade show" role="alert">
                    {{$alerts['message'][$i]}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endfor
        @endisset
        </div>
{{--        <div class="alert alert-warning alert-dismissible " role="alert">--}}
{{--            Сайт находиться в активной стадии разработки, возможны ошибки и изменения, для мобильных устройств рекомендуеться планшетный режим--}}

{{--        </div>--}}
        <main class="py-4 mx-3 ">
            @yield('content')
        </main>
        <!-- Вариант 1: Bootstrap в связке с Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>    </div>


</body>
</html>
