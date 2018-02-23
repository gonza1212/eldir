@extends('layouts.app')

@section('title', 'Inicio')

@section('content')
<div class="container size-letra">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>¡Bienvenido {{ Auth::user()->name }}! <i class="fas fa-hand-spock"></i></h3>
                </div>
                <div class="panel-body text-center">
                    <div class="hidden-xs"><a class="btn btn-primary btn-comoVoy" id='collapseComoVoy' data-toggle="collapse" href="#comoVoy">Como voy este mes</a></div>
                    <div class="visible-xs"><a class="btn btn-primary btn-comoVoy" id='collapseComoVoy' data-toggle="collapse" href="#comoVoy">Como voy</a></div>
                    <div id="comoVoy" class="panel-collapse collapse">
                        <h3>{{ $actividadActual[0] }}<small> horas con </small>{{ $actividadActual[1] }}<small> minutos, </small>{{ $actividadActual[2] }}<small> publicaciones, </small>{{ $actividadActual[3] }}<small> videos y </small>{{ $actividadActual[4] }}<small> revisitas.</small></h3>
                        <p>Has salido: </p>
                        @if($veces == 1)
                        <h3>{{ $veces }}<small> vez</small></h3>
                        @else
                        <h3>{{ $veces }}<small> veces</small></h3>
                        @endif
                    </div>
                    <hr>
                    <div class="col-sm-3 text-center">
                        <a class="btn btn-primary btn-home" href="{!! route('actividad.create') !!}"><i class="fas fa-book fa-4x"></i></a>
                        <br>
                        <br>
                        <p class="text-home">Cargar Actividad</p>
                    </div>
                    <div class="col-sm-3 text-center">
                        <a class="btn btn-primary btn-home" href="{!! route('revisita.index') !!}"><i class="fas fa-address-book fa-4x"></i></a>
                        <br>
                        <br>
                        <p class="text-home">Cargar Revisita</p>
                    </div>
                    <div class="col-sm-3 text-center">
                        <a class="btn btn-primary btn-home" href="{!! route('informe') !!}"><i class="fas fa-list-alt fa-4x"></i></a>
                        <br>
                        <br>
                        <p class="text-home">Ver Informe</p>
                    </div>
                    <div class="col-sm-3 text-center">
                        <a class="btn btn-primary btn-home" href="{!! route('notas.create') !!}"><i class="fas fa-sticky-note fa-4x"></i></a>
                        <br>
                        <br>
                        <p class="text-home">Cargar Nota</p>
                    </div>
                </div>
          </div>
      </div>
    </div>
</div>

@endsection