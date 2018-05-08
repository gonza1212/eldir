@extends('layouts.app')

@section('title', 'Inicio')

@section('content')
<div class="container size-letra">
    <div class="row">
        <div class="col-md-12">
            @if(\Auth::user()->mejorasNoVistas())
            <div class="row alert alert-primary alert-dismissible fade show" role="alert">
                <div class="col-md-10">
                    ¿Ya viste lo <a class="a-home-mejoras font-weight-bold" href="{{ route('ayuda.version') }}">nuevo</a>?
                    <hr>
                    <p>¡Revisitas y Estudios! Finalmente se pueden cargar datos de revisitas, sesiones de estudio y todo lo referente a las personas interesadas.</p>
                    <p>Buscador de Personas interesadas para encontrar rápidamente a alguien.</p>
                    <p>Revisitas listadas por última visita: para saber cuál es el que debería visitar pronto</p>
                    <p>Vista de Inicio Renovada</p>
                </div>
                <div class="col-md-2 text-right" style="padding: 0px;">
                    <a class="btn-btn-info btn-sm" href="{{ route('no-mostrar') }}">No mostrar de nuevo</a>
                </div>                
            </div>
            @endif
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>¡Hola {{ Auth::user()->name }}! <i class="fas fa-hand-spock"></i></h3>
                </div>
                <div class="panel-body text-center">
                    <div class="d-none d-sm-block">
                        <a class="btn btn-primary btn-comoVoy" id='collapseHome' data-toggle="collapse" href="#comoVoy">Como voy este mes</a>
                        <a class="btn btn-danger btn-comoVoy" id='collapseHome' data-toggle="collapse" href="#revisitas">Revisitas Urgentes</a>
                    </div>
                    <div class="d-md-none d-lg-none d-xl-none d-sm-none">
                        <a class="btn btn-primary btn-comoVoy" id='collapseHome' data-toggle="collapse" href="#comoVoy">Como voy</a>
                        <a class="btn btn-danger btn-comoVoy" id='collapseHome' data-toggle="collapse" href="#revisitas">Rev. Urgentes</a>
                    </div>                    
                    <div id="comoVoy" class="panel-collapse collapse">
                        <br>
                        <h3>{{ $actividadActual[0] }}<small> horas con </small>{{ $actividadActual[1] }}<small> minutos, </small>{{ $actividadActual[2] }}<small> publicaciones, </small>{{ $actividadActual[3] }}<small> videos, </small>{{ $actividadActual[4] }}<small> revisitas y </small>{{ $actividadActual[5] }}<small> estudios.</small></h3>                        
                        @if($veces == 1)
                        <h3><small>Has salido:</small> {{ $veces }} vez</h3>
                        @else
                        <h3><small>Has salido:</small> {{ $veces }} veces</h3>
                        @endif
                    </div>
                    <div id="revisitas" class="panel-collapse collapse">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Dirección</th>
                                        <th>Últ. Visita</th>
                                        <th>Detalles</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($personas as $p)
                                    <tr>
                                        <td>{{ $p->nombre }}</td>
                                        <td>{{ $p->direccion->calle_1 . ' N° ' . $p->direccion->numero }}</td>
                                        @if(count($p->visitas) > 0)
                                        <td>{!! Carbon\Carbon::parse($p->visitas[0]['fecha'])->toFormattedDateString() !!}</td>
                                        @else
                                        <td>S/ Visitas</td>
                                        @endif
                                        <td><a class="btn btn-primary btn-sm" href="{{ route('persona.show', $p->id) }}"><i class="fas fa-eye"></i></a></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <hr>
                        @if(\Auth::user()->meta_activa())
                            <h4 class="size-letra">Mi meta para este mes es de <strong>{{ \Auth::user()->meta }} hrs.</strong></h4>
                            @php
                            $fecha = \Carbon\Carbon::now();
                            $min_dia = (\Auth::user()->meta * 60) / $fecha->daysInMonth;
                            $horas_deber = intdiv($min_dia * $fecha->day, 60);
                            $min_deber = ($min_dia * $fecha->day) % 60;
                            if($actividadActual[0] >= \Auth::user()->meta) {
                                @endphp
                                <h3 class="text-success font-weight-bold"><i class="fas fa-bullhorn"></i> ¡¡¡ LLEGUEEE !!! <i class="far fa-smile fa-lg fa-spin"></i> <i class="far fa-smile fa-lg fa-spin" data-fa-transform="rotate-90"></i> <i class="far fa-smile fa-lg fa-spin" data-fa-transform="rotate-180"></i> <a target="_blank" href="https://www.jw.org/es/publicaciones/biblia/bi12/libros/Malaqu%C3%ADas/3/#v39003010">(Mal. 3:10)</a></h3>
                                @php
                            }
                            else if($actividadActual[0] > $horas_deber || $actividadActual[0] == $horas_deber && $actividadActual[1] >= $min_deber) {
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
                    <div class="row">
                        <div class="col text-center">
                            <a class="btn btn-primary btn-home" href="{!! route('actividad.create') !!}"><i class="fas fa-book fa-3x"></i></a>
                            <br>
                            <br>
                            <p class="text-home">+ Actividad</p>
                        </div>
                        <div class="col text-center">
                            <a class="btn btn-primary btn-home" href="{!! route('visita.create') !!}"><i class="fas fa-address-book fa-3x"></i></a>
                            <br>
                            <br>
                            <p class="text-home">+ Visita Inicial</p>
                        </div>
                        <div class="col text-center">
                            <a class="btn btn-primary btn-home" href="{!! route('persona.index') !!}"><i class="fas fa-user-plus fa-3x" style="margin-left: -3px !important;"></i></a>
                            <br>
                            <br>
                            <p class="text-home">+ Revisita</p>
                        </div>
                        <div class="col text-center">
                            <a class="btn btn-primary btn-home" href="{!! route('notas.create') !!}"><i class="fas fa-sticky-note fa-3x"></i></a>
                            <br>
                            <br>
                            <p class="text-home">+ Nota</p>
                        </div>
                        <div class="col text-center">
                            <a class="btn btn-primary btn-home" href="{!! route('meta') !!}"><i class="fas fa-flag-checkered fa-3x"></i></a>
                            <br>
                            <br>
                            <p class="text-home">Meta</p>
                        </div>
                        <div class="col text-center">
                            <a class="btn btn-primary btn-home" href="{!! route('informe') !!}"><i class="fas fa-list-alt fa-3x"></i></a>
                            <br>
                            <br>
                            <p class="text-home">Informe</p>
                        </div>
                    </div>
                </div>
          </div>
      </div>
    </div>
</div>

@endsection