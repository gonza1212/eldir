@extends('layouts.app')

@section('title', "Editar '" . $nota->titulo)

@include('layouts.errores')

@section('content')

{!! Form::model($nota, ['route' => ['notas.update', $nota->id], 'method' => 'PUT']) !!}
	<div class="form-group">
		{!! Form::label('titulo', 'Titulo') !!}
		{!! Form::text('titulo', null, ['class' => 'form-control', 'placeholder' => 'Opcional']) !!}
	</div>
	<div class="form-group">
		{!! Form::label('contenido', 'Contenido') !!}
		{!! Form::textArea('contenido', null, ['class' => 'form-control text-area-contenido', 'required', 'placeholder' => 'Escribe aquí tu nota...']) !!}
	</div>
	<div class="form-group">
		{!! Form::submit('Guardar Nota', ['class' => 'btn btn-primary']) !!}
	</div>
	{!! Form::close() !!}

@endsection