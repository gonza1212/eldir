<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta name="theme-color" content="#00b2e0">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" type="image/png" href="{{ asset('images/cuaderno.png') }}" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'Laravel'))</title>

    <!-- Styles -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
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
<body onload="llenarVentana();">
    <div id="app">
        <nav class="navbar sticky-top navbar-expand-md navbar-dark bg-celeste-eldir">
            @guest
            <a class="navbar-brand" href="{{ url('/') }}">
                <i class="fab fa-laravel"></i> {{ config('app.name', 'Laravel') }}
            </a>
            @else
            <a class="navbar-brand" href="{{ route('home') }}"><i class="fas fa-home"></i></a>
            @endguest
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    @guest
                        <li></li>
                    @else
                    @if(Auth::user() && Auth::user()->admin())
                        <li class="nav-item">
                            <a class="nav-link" href="{!! route('users.index') !!}"><i class="fas fa-user-cog"></i> Usuarios</a>
                        </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('actividad.index') }}"><i class="fas fa-book"></i> Actividad</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('persona.index') }}"><i class="fas fa-users"></i> Personas Interesadas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('informe') }}"><i class="fas fa-list-alt"></i> Informe</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('notas.index') }}"><i class="fas fa-sticky-note"></i> Notas</a>
                    </li>
                    @endguest
                </ul>
                <ul class="navbar-nav ml-auto">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('ayuda.main') }}"><i class="fas fa-question-circle"></i></a>
                        </li>
                    @else
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-cogs"></i> Opciones</a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('meta') }}"><i class="fas fa-flag-checkered"></i> Meta</a>
                            @if(Auth::user()->letra_grande)
                            <a class="dropdown-item" href="{{ route('ajustar-letra') }}"><i class="fas fa-font"></i> Letra Normal</a>
                            @else
                            <a class="dropdown-item" href="{{ route('ajustar-letra') }}"><i class="fas fa-font fa-2x"></i> Letra Grande</a>
                            @endif
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('ayuda.main') }}"><i class="fas fa-question-circle"></i> Ayuda</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt"></i>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                    @endguest
                </ul> 
            </div>
        </nav>
        <div class="container size-letra">
            <div class="row">
                <div class="col-md-12">
                    @include('flash::message')
                </div>
            </div>
        </div>
        @yield('content')
<br>
<div class="container">
    <div class="row">
        <div class="col-md-12">
        <footer>
            <p class="text-center"><a target="_blank" rel="license" href="http://creativecommons.org/licenses/by-sa/4.0/"><img alt="Licencia Creative Commons" style="border-width:0" src="https://i.creativecommons.org/l/by-sa/4.0/88x31.png" /></a><br /><span xmlns:dct="http://purl.org/dc/terms/" href="http://purl.org/dc/dcmitype/InteractiveResource" property="dct:title" rel="dct:type"><a href="{{ route('ayuda.version') }}" class="aVersion">Eldir v{{ Config::get('constants.NUM_VERSION') }} Anotador de Actividad</a></span> está hecho con <i class="fas fa-heart"></i> por <span xmlns:cc="http://creativecommons.org/ns#" property="cc:attributionName">Millapinda Gonzalo</span> y se distribuye bajo una <a target="_blank" rel="license" href="http://creativecommons.org/licenses/by-sa/4.0/">Licencia Creative Commons Atribución-CompartirIgual 4.0 Internacional</a>.</p><h5 class="text-center"> Es y siempre será GRATIS. Give a Star the project on <a target="_blank" href="https://github.com/gonza1212/eldir"> GitHub <i class="fab fa-github"></i></a></h5>
        </footer>
        </div>
    </div>
</div>
<br>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/Popper.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
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
    <script type="text/javascript">
        $(document).ready(function()
            {
            $("#selectorCondicion").click(function () {
                console.log($("#selectorCondicion").val())
            //saco el valor accediendo a un input de tipo text y name = nombre2 y lo asigno a uno con name = nombre3 
            if($("#selectorCondicion").val() == "Precursor Auxiliar")
                $("#meta").val(50)
            if($("#selectorCondicion").val() == "Precursor Regular")
                $("#meta").val(70)
            });     
        });
    </script>
</body>
</html>
