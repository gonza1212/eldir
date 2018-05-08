@extends('layouts.app')

@section('title', 'Cargar Actividad')

@include('layouts.errores')

@section('content')
<div class="container rgba size-letra">
    <div class="row">
        <div class="col-md-12">
			{!! Form::open(['route' => 'actividad.store', 'files' => true]) !!}
				<div class="form-group">
					{!! Form::label('fecha', 'Fecha') !!}
					{!! Form::date('fecha', \Carbon\Carbon::now(), ['class' => 'form-control size-letra', 'required']) !!}
				</div>
				{!! Form::label(null, 'Tiempo predicado (horas:minutos)') !!}
				<div class="form-group input-group-prepend">
					{!! Form::number('horas', null, ['class' => 'form-control size-letra', 'placeholder' => 'Horas']) !!}
					<label class="input-group-text"> : </label>
					{!! Form::number('minutos', null, ['class' => 'form-control size-letra', 'placeholder' => 'Minutos']) !!}
				</div>
				<div class="form-group">
					{!! Form::label('acompanante', 'Acompañante') !!}
					{!! Form::text('acompanante', null, ['class' => 'form-control size-letra', 'placeholder' => 'Nombre']) !!}
				</div>
				{!! Form::label('publicaciones', 'Publicaciones y Videos') !!}
				<div class="form-group input-group">		
					{!! Form::number('publicaciones', null, ['class' => 'form-control size-letra', 'placeholder' => 'Impresas y digitales']) !!}
				<label class="input-group-text"></label>
					{!! Form::number('videos', null, ['class' => 'form-control size-letra', 'placeholder' => 'Cantidad de reproducciones']) !!}
				</div>
				<div class="form-group">
					{!! Form::label('revisitas', 'Revisitas') !!}
					{!! Form::number('revisitas', null, ['class' => 'form-control size-letra', 'placeholder' => 'Cantidad']) !!}
				</div>
				<div class="form-group">
					{!! Form::submit('Guardar', ['class' => 'btn btn-primary size-letra']) !!}
				</div>
				{!! Form::close() !!}
		</div>
	</div>
</div>
@endsection
