<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>


        <title>Stavebnictvo / @yield('title') </title>

        <!-- SOME META DATA -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- SCRIPTS -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- STYLES -->
        <link rel="stylesheet" href="{{asset('css/app.css')}}">

        <!-- ICO -->
        <link rel="icon" type="image/png" href="{{asset("img/pickaxe-logo.png")}}">

        <!-- FONTS -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">


    </head>
    <body>
        <div id="app">
            <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
                <!-- Brand -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{asset('img/pickaxe-logo.png')}}" alt="Logo" style="width:20px;">
                </a>

                <!-- Links -->
                <ul class="navbar-nav">
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/') }}">Úvod</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('catalog') }}">Cenník</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('unit') }}">Jednotky</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('item') }}" class="nav-link">Všetky položky</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('project') }}">Projekty</a>
                        </li>

                        <li class="nav-item">
                            <a onclick="logout(event);" href="{{ route('logout') }}" class="nav-link">Odhlasit sa</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                @csrf
                            </form>
                        </li>
                    @endauth
                </ul>
            </nav>
            <main role="main" class="container">
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger" role="alert">
                            {{$error}}
                        </div>
                    @endforeach
                @endif
                <br>
                @yield('content')
            </main>
            <footer class="page-footer font-small indigo" style="padding: 15px;">
            </footer>
        </div>
        <script>
            function logout(event) {
                event.preventDefault();
                document.getElementById('logout-form').submit();
            }
        </script>
        @yield('js')
    </body>
</html>
