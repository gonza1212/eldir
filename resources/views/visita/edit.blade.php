@extends('layouts.app')

@section('title', 'Editar Revisita')

@section('content')
<div class="container rgba size-letra">
	<div class="row">
		<div class="col-md-12">
			@if($visita->persona->observaciones != null)
			<h4><strong>Revisita a {{ $visita->persona->nombre }}</strong> ({{ $visita->persona->observaciones }})</h4>
			@else
			<h4><strong>Revisita a {{ $visita->persona->nombre }}</strong></h4>
			@endif
		</div>		
		<div class="col-md-6">
			<p>{{ $visita->persona->direccion->calle_1 . ' N°' . $visita->persona->direccion->numero }}</p>
		</div>
	</div>
    <div class="row">
			@include('layouts.errores')
        <div class="col-md-12">
			{!! Form::model($visita, ['route' => ['visita.update', $visita->id],  'method' => 'PUT']) !!}
		    <div class="form-group">
				{!! Form::date('fecha', \Carbon\Carbon::parse($visita->fecha), ['class' => 'form-control size-letra', 'required']) !!}
			</div>
			<div class="form-group">
				{!! Form::text('tema', null, ['class' => 'form-control size-letra', 'placeholder' => 'Tema hablado']) !!}
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
				{!! Form::text('obs_2', $visita->observaciones, ['class' => 'form-control size-letra', 'placeholder' => 'Observaciones...']) !!}
			</div>
			<div class="form-group">
				{!! Form::hidden('persona_id', $visita->persona->id, ['class' => 'form-control size-letra']) !!}
			</div>
			<div class="form-group">
				{!! Form::hidden('nombre', $visita->persona->nombre, ['class' => 'form-control size-letra']) !!}
			</div>
			<div class="form-group">
				{!! Form::submit('Guardar', ['class' => 'btn btn-primary size-letra']) !!}
			</div>
			{!! Form::close() !!}
		</div>
	</div>
</div>
@endsection