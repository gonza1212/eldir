@extends('layouts.app')

@section('title', 'Nueva Revisita')

@section('content')
<div class="container rgba size-letra">
	<div class="row">
		<div class="col-md-12">
			@if($persona->observaciones != null)
			<h4><strong>Revisita a {{ $persona->nombre }}</strong> ({{ $persona->observaciones }})</h4>
			@else
			<h4><strong>Revisita a {{ $persona->nombre }}</strong></h4>
			@endif
		</div>		
		<div class="col-md-6">
			<p>{{ $persona->direccion->calle_1 . ' N°' . $persona->direccion->numero }}</p>
		</div>
	</div>
    <div class="row">
			@include('layouts.errores')
        <div class="col-md-12">
			{!! Form::open(['route' => 'revisita.store']) !!}
		    <div class="form-group">
				{!! Form::date('fecha', \Carbon\Carbon::now(), ['class' => 'form-control size-letra', 'required']) !!}
			</div>
			<div class="form-group">
				{!! Form::text('tema', $pendiente, ['class' => 'form-control size-letra', 'placeholder' => 'Tema hablado']) !!}
			</div>
			<div class="form-group">
				{!! Form::text('textos', null, ['class' => 'form-control size-letra', 'placeholder' => 'Textos leídos']) !!}
			</div>
			<div class="form-group">
				{!! Form::text('publicacion', null, ['class' => 'form-control size-letra', 'placeholder' => 'Publicación dejada']) !!}
			</div>
			<div class="form-group">
				{!! Form::text('pendiente', null, ['class' => 'form-control size-letra', 'placeholder' => 'Tema o pregunta pendiente']) !!}
			</div>
			<div class="form-group">
				{!! Form::text('obs_2', null, ['class' => 'form-control size-letra', 'placeholder' => 'Observaciones...']) !!}
			</div>
			<div class="form-group">
				{!! Form::hidden('persona_id', $persona->id, ['class' => 'form-control size-letra']) !!}
			</div>
			<div class="form-group">
				{!! Form::hidden('nombre', $persona->nombre, ['class' => 'form-control size-letra']) !!}
			</div>
			<div class="form-group">
				{!! Form::submit('Guardar', ['class' => 'btn btn-primary size-letra']) !!}
			</div>
			{!! Form::close() !!}
		</div>
	</div>
</div>
@endsection