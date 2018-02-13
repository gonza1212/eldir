@extends('layouts.app')

@section('title', 'Cargar Actividad')

@include('layouts.errores')

@section('content')

{!! Form::open(['route' => 'actividad.store', 'files' => true]) !!}

	
	<div class="form-group">
		{!! Form::label('fecha', 'Fecha') !!}
		{!! Form::date('fecha', \Carbon\Carbon::now(), ['class' => 'form-control size-letra', 'required']) !!}
	</div>
	{!! Form::label(null, 'Tiempo predicado (horas:minutos)') !!}
	<div class="form-group input-group">

		{!! Form::number('horas', null, ['class' => 'form-control size-letra', 'placeholder' => 'Horas', 'required']) !!}
		<span class="input-group-addon">:</span>
		{!! Form::number('minutos', null, ['class' => 'form-control size-letra', 'placeholder' => 'Minutos (opcional)']) !!}
	</div>
	<div class="form-group">
		{!! Form::label('acompanante', 'Acompañante') !!}
		{!! Form::text('acompanante', null, ['class' => 'form-control size-letra', 'placeholder' => 'Nombre (opcional)']) !!}
	</div>
	{!! Form::label('publicaciones', 'Publicaciones y Videos') !!}
	<div class="form-group input-group">		
		{!! Form::number('publicaciones', null, ['class' => 'form-control size-letra', 'placeholder' => 'Impresas y digitales (opcional)']) !!}
	<span class="input-group-addon"></span>
		{!! Form::number('videos', null, ['class' => 'form-control size-letra', 'placeholder' => 'Cantidad de reproducciones (opcional)']) !!}
	</div>
	<div class="form-group">
		{!! Form::submit('Guardar', ['class' => 'btn btn-primary size-letra']) !!}
	</div>
	{!! Form::close() !!}

@endsection
