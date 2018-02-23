@extends('layouts.app')

@section('title', 'Cargar Actividad')

@include('layouts.errores')

@section('content')
<div class="container size-letra">
    <div class="row">
        <div class="col-md-12">
			{!! Form::model( $actividad, ['route' => ['actividad.update', $actividad->id], 'method' => 'PUT']) !!}
				<div class="form-group">
					{!! Form::label('fecha', 'Fecha') !!}
					{!! Form::date('fecha', \Carbon\Carbon::parse($actividad->fecha), ['class' => 'form-control size-letra', 'required']) !!}
				</div>
				{!! Form::label(null, 'Tiempo predicado (horas:minutos)') !!}
				<div class="form-group input-group">

					{!! Form::number('horas', null, ['class' => 'form-control size-letra', 'placeholder' => 'Horas']) !!}
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
					{!! Form::label('revisitas', 'Revisitas') !!}
					{!! Form::text('revisitas', null, ['class' => 'form-control size-letra', 'placeholder' => 'Cantidad (opcional)']) !!}
				</div>
				<div class="form-group">
					{!! Form::submit('Guardar', ['class' => 'btn btn-primary size-letra']) !!}
				</div>
				{!! Form::close() !!}
		</div>
	</div>
</div>
@endsection