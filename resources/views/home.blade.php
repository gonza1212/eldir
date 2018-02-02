@extends('layouts.app')

@section('title', 'Inicio')

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">
        <h3>¡Bienvenido {{ Auth::user()->name }}! <i class="fas fa-hand-spock"></i></h3>
    </div>
    <div class="panel-body text-center">
        <p>Como vas este mes:</p>
        <h3>{{ $actividadActual[0] }}<small> horas con </small>{{ $actividadActual[1] }}<small> minutos, </small>{{ $actividadActual[2] }}<small> publicaciones y </small>{{ $actividadActual[3] }}<small> videos.</small></h3>
        <hr>
        <p>Has salido: </p>
        @if($veces == 1)
        <h3>{{ $veces }}<small> vez</small></h3>
        @else
        <h3>{{ $veces }}<small> veces</small></h3>
        @endif
        <br>
        <a href="{{ route('actividad.index') }}" class="btn btn-primary">Ver registros</a>
    </div>
</div>
@endsection
