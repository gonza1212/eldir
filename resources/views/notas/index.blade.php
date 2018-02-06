@extends('layouts.app')

@section('title', 'Mis Notas')

@section('content')

	<a href="{{ route('notas.create') }}" class="btn btn-primary">Crear Nota</a>
	<br>
	<hr>
	<div class="table-responsive rgba">
		<table class="table">
		  <thead>
		    <tr>
		      <th>Fecha</th>
		      <th>Título</th>
		      <th>Opciones</th>
		    </tr>
		  </thead>
		  <tbody>
		  	@foreach($notas as $n)
		    <tr>
		      <td>{!! Carbon\Carbon::parse($n->fecha)->toFormattedDateString() !!}</td>
		      <td><a href="{{ route('notas.show', $n->id) }}" class="aVersion">{{ $n->titulo }}</a></td>
		      <td><a href="{{ route('notas.edit', $n->id) }}" class="btn btn-warning"><i class="fas fa-edit"></i></a> <a href="javascript:eliminar({{ $n->id }}, 'notas')" class="btn btn-danger"><i class="fas fa-trash"></i></a></td>
		    </tr>
		    @endforeach
		  </tbody>
		</table>
	</div>
		<div class="text-center">
		{!! $notas->render() !!}
	</div>
@endsection