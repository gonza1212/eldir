<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" type="image/png" href="{{ asset('images/cuaderno.png') }}" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'Laravel'))</title>

    <!-- Styles -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/fa-svg-with-js.css') }}" rel="stylesheet">
    <link href="{{ asset('css/estilos.css') }}" rel="stylesheet">
    @if(Auth::user() && Auth::user()->letra_grande)
    <style type="text/css">
    .size-letra {
        font-size: x-large;
    }
    input {
        height: 2em !important;
    }
    </style>
    @endif
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top" id="navbar">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    @guest
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <i class="fab fa-laravel"></i> {{ config('app.name', 'Laravel') }}
                    </a>
                    @else
                    <a class="navbar-brand" href="{{ route('home') }}"><i class="fas fa-home"></i></a>
                    @endguest
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        @guest
                            <li></li>
                        @else
                            @if(Auth::user() && Auth::user()->admin())
                                <li><a href="{!! route('users.index') !!}"><i class="fas fa-users"></i> Usuarios</a></li>
                            @endif
                            <li><a href="{{ route('actividad.index') }}"><i class="fas fa-book"></i> Actividad</a></li>
                            <li><a href="{{ route('revisita.index') }}"><i class="fas fa-address-book"></i> Revisitas</a></li>
                            <li><a href="{{ route('informe') }}"><i class="fas fa-list-alt"></i> Informe</a></li>
                            <li><a href="{{ route('notas.index') }}"><i class="fas fa-sticky-note"></i> Notas</a></li>
                        @endguest
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                            <li></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true"><i class="fas fa-cogs"></i> <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        @if(Auth::user()->letra_grande)
                                        <a href="{{ route('ajustar-letra') }}"><i class="fas fa-font"></i> Letra Normal</a>
                                        @else
                                        <a href="{{ route('ajustar-letra') }}"><i class="fas fa-font fa-2x"></i> Letra Grande</a>
                                        @endif
                                    </li>
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt"></i> 
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                        <li><a href="{{ route('ayuda.main') }}"><i class="fas fa-question-circle"></i></a></li>
                    </ul>
                </div>
            </div>
        </nav>
<div class="container size-letra">
    <div class="row">
        <div class="col-md-12">
        @include('flash::message')
        @yield('content')
        </div>
    </div>
</div>
<br>
<div class="container">
    <div class="row">
        <div class="col-md-12">
        <footer>
            <p class="text-center"><a rel="license" href="http://creativecommons.org/licenses/by-sa/4.0/"><img alt="Licencia Creative Commons" style="border-width:0" src="https://i.creativecommons.org/l/by-sa/4.0/88x31.png" /></a><br /><span xmlns:dct="http://purl.org/dc/terms/" href="http://purl.org/dc/dcmitype/InteractiveResource" property="dct:title" rel="dct:type"><a href="{{ route('ayuda.version') }}" class="aVersion">Eldir v0.4.5 - Anotador de Actividad</a></span> por <span xmlns:cc="http://creativecommons.org/ns#" property="cc:attributionName">Millapinda Gonzalo</span> se distribuye bajo una <a rel="license" href="http://creativecommons.org/licenses/by-sa/4.0/">Licencia Creative Commons Atribución-CompartirIgual 4.0 Internacional</a>.</p>
        </footer>
        </div>
    </div>
</div>
<br>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/fontawesome-all.min.js') }}"></script>
    <script>
        function eliminar(id, tabla) {
       eliminar=confirm("¿Deseas eliminar este registro?");
       if (eliminar)
       window.location.href= tabla+"/"+id+"/destroy";//página web a la que te redirecciona si confirmas la eliminación
        else
        alert('No se ha podido eliminar el registro..')
        }
    </script>
</body>
</html>
