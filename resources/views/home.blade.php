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
                        @if($veces == 1)
                        <h3><small>Has salido:</small> {{ $veces }} vez</h3>
                        @else
                        <h3><small>Has salido:</small> {{ $veces }} veces</h3>
                        @endif
                    </div>
                    <hr>
                        @if(\Auth::user()->meta_activa())
                            <h4 class="size-letra">Mi meta para este mes es de <strong>{{ \Auth::user()->meta }} hrs.</strong></h4>
                            @php
                            $fecha = \Carbon\Carbon::now();
                            $min_dia = (\Auth::user()->meta * 60) / $fecha->daysInMonth;
                            $horas_deber = intdiv($min_dia * $fecha->day, 60);
                            $min_deber = ($min_dia * $fecha->day) % 60;
                            if($actividadActual[0] > $horas_deber || $actividadActual[0] == $horas_deber && $actividadActual[1] >= $min_deber) {
                                @endphp
                                <h3 class="text-success font-weight-bold"><i class="far fa-thumbs-up"></i> ¡Voy adelantado! No tengo que aflojar <a target="_blank" href="https://www.jw.org/es/publicaciones/biblia/bi12/libros/Eclesiast%C3%A9s/11/#v21011006">(Ecl. 11:6)</a><i class="fas fa-child"></i><br><br>Para hoy debería llevar {{ $horas_deber .':'.$min_deber }}</h3>
                                @php
                            } else {
                                @endphp
                                <h3 class="text-danger"><i class="far fa-thumbs-down"></i> ¡Bajón! Voy atrasado, Tengo que salir más <a target="_blank" href="https://www.jw.org/es/publicaciones/biblia/bi12/libros/salmos/126/#v19126006">(Salmo 126:6)</a><br><br>Para hoy debería llevar {{ $horas_deber .':'.$min_deber }}</h3>
                                @php
                            }
                            @endphp
                            <hr>
                        @endif
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