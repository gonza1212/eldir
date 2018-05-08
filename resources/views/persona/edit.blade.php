@extends('layouts.app')

@section('title', 'Editar ' . $persona->nombre)

@section('content')
<div class="container rgba size-letra">
    <div class="row">
        @include('layouts.errores')
        <div class="col-md-12">
        	{!! Form::model($persona->direccion, ['route' => ['persona.update', $persona->id],  'method' => 'PUT']) !!}
        	<h4><strong>Datos de {{ $persona->nombre }}</strong></h4>
    		<div class="form-group">
				{!! Form::text('nombre', $persona->nombre, ['class' => 'form-control size-letra', 'required', 'placeholder' => 'Nombre y Apellido']) !!}
			</div>
        	<div class="form-group input-group">
				{!! Form::number('edad', $persona->edad, ['class' => 'form-control size-letra', 'placeholder' => 'Edad aproximada']) !!}
				<label class="input-group-text">Tel:</label>
				{!! Form::text('tel', $persona->telefono, ['class' => 'form-control size-letra', 'placeholder' => 'Ej: 2804000111']) !!}
			</div>
			<div class="form-group">
				{!! Form::text('email', $persona->email, ['class' => 'form-control size-letra', 'placeholder' => 'Email']) !!}
			</div>
			<div class="form-group">
				{!! Form::text('obs', $persona->observaciones, ['class' => 'form-control size-letra', 'placeholder' => 'Observaciones...']) !!}
			</div>
			<hr style="border: 1px solid #bbbbbb;">
			<h5><strong>Dirección</strong></h5>
			<div class="form-group input-group">
				{!! Form::text('calle_1', null, ['class' => 'form-control size-letra', 'placeholder' => 'Calle']) !!}
				<label class="input-group-text"> N° </label>
				{!! Form::number('numero', null, ['class' => 'form-control size-letra', 'placeholder' => 'Altura o N° de Casa']) !!}
			</div>
        	<div class="form-group">
				{!! Form::text('barrio', null, ['class' => 'form-control size-letra', 'placeholder' => 'Barrio']) !!}
			</div>
			<div class="form-group input-group">
				{!! Form::number('depto', null, ['class' => 'form-control size-letra', 'placeholder' => 'N° dpto.']) !!}
				<label class="input-group-text"> - </label>
				{!! Form::number('territorio', null, ['class' => 'form-control size-letra', 'placeholder' => 'N° Territorio']) !!}
			</div>
			<div class="form-group">
				{!! Form::label('fecha', '¿La casa queda en una esquina?') !!}
				{!! Form::text('calle_2', null, ['class' => 'form-control size-letra', 'placeholder' => 'Calle secundaria']) !!}
			</div>
			{!! Form::label('entre_a', '¿La casa no tiene N°?') !!}
			<div class="form-group input-group">
				<label class="input-group-text">Entre:</label>
				{!! Form::text('entre_a', substr($persona->direccion->entre, 0, strpos($persona->direccion->entre, ' y ')), ['class' => 'form-control size-letra', 'placeholder' => 'Calle A']) !!}
				<label class="input-group-text"> y </label>
				{!! Form::text('entre_b', substr($persona->direccion->entre, strpos($persona->direccion->entre, ' y ')+3), ['class' => 'form-control size-letra', 'placeholder' => 'Calle B']) !!}
			</div>
			<div class="form-group">
				{!! Form::label('obs_3', '¿Algo distintivo de la casa para ubicarla mejor?') !!}
				{!! Form::text('obs_3', $persona->direccion->observaciones, ['class' => 'form-control size-letra', 'placeholder' => 'Observaciones...']) !!}
			</div>
			<div class="form-group">
				{!! Form::submit('Guardar', ['class' => 'btn btn-primary size-letra']) !!}
			</div>
			{!! Form::close() !!}
		</div>
	</div>
</div>
@endsection