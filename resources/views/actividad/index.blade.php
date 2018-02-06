
@extends('layouts.app')

@section('title', 'Mi Actividad')

@section('content')

	<a href="{{ route('actividad.create') }}" class="btn btn-primary">Cargar Actividad</a>
	<br>
	<hr>
	<div class="table-responsive rgba">
		<table class="table">
		  <thead>
		    <tr>
		      <th>Fecha</th>
		      <th>Horas</th>
		      <th>Acompañante</th>
		      <th>Publicaciones</th>
		      <th>Videos</th>
		      <th>Opciones</th>
		    </tr>
		  </thead>
		  <tbody>
		  	@foreach($actividades as $a)
		    <tr>
		      <td>{!! Carbon\Carbon::parse($a->fecha)->toFormattedDateString() !!}</td>
		      @if($a->minutos > 9)
		      <td>{{ $a->horas }}:{{ $a->minutos }}</td>
		      @else
		      <td>{{ $a->horas }}:0{{ $a->minutos }}</td>
		      @endif
		      <td>{{ $a->acompanante }}</td>
		      <td>{{ $a->publicaciones }}</td>
		      <td>{{ $a->videos }}</td>
		      <td><a href="javascript:eliminar({{ $a->id }}, 'actividad')" class="btn btn-danger"><i class="fas fa-trash"></i></a></td>
		    </tr>
		    @endforeach
		  </tbody>
		</table>
	</div>
		<div class="text-center">
		{!! $actividades->render() !!}
	</div>
@endsection