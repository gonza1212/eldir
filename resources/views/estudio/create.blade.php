@extends('layouts.app')

@section('title', 'Nueva Sesión de Estudio')

@section('content')
<div class="container rgba size-letra">
	<div class="row">
		<div class="col-md-12">
			@if($persona->observaciones != null)
			<h4><strong>Sesión de Estudio con {{ $persona->nombre }}</strong> ({{ $persona->observaciones }})</h4>
			@else
			<h4><strong>Sesión de Estudio con {{ $persona->nombre }}</strong></h4>
			@endif
		</div>		
		<div class="col-md-6">
			<p>{{ $persona->direccion->calle_1 . ' N°' . $persona->direccion->numero }}</p>
		</div>
	</div>
    <div class="row">
			@include('layouts.errores')
        <div class="col-md-12">
			{!! Form::open(['route' => 'estudio.store']) !!}
		    <div class="form-group">
				{!! Form::date('fecha', \Carbon\Carbon::now(), ['class' => 'form-control size-letra', 'required']) !!}
			</div>
			@if($ultima != null)
			<div class="form-group">
				{!! Form::select('publicacion', $publicaciones, substr($ultima->publicacion, 5, strrpos($ultima->publicacion, '$cap:')-5),['class' => 'form-control size-letra']) !!}
			</div>
			<div class="form-group input-group">
				<label class="input-group-text">Cap.:</label>
				{!! Form::text('cap', substr($ultima->publicacion, strrpos($ultima->publicacion, '$cap:')+5, strrpos($ultima->publicacion, '$parr:')-(strrpos($ultima->publicacion, '$cap:')+5)), ['class' => 'form-control size-letra', 'placeholder' => 'Capítulo o Lección']) !!}
				<label class="input-group-text">Párr.:</label>
				{!! Form::text('parr', substr($ultima->publicacion,  strrpos($ultima->publicacion, '$parr:')+6), ['class' => 'form-control size-letra', 'placeholder' => 'Párrafo']) !!}
			</div>
			@else
			<div class="form-group">
				{!! Form::select('publicacion', $publicaciones, $publicaciones['ensena'],['class' => 'form-control size-letra']) !!}
			</div>
			<div class="form-group input-group">
				<label class="input-group-text">Cap.:</label>
				{!! Form::text('cap', null, ['class' => 'form-control size-letra', 'placeholder' => 'Capítulo o Lección']) !!}
				<label class="input-group-text">Párr.:</label>
				{!! Form::text('parr', null, ['class' => 'form-control size-letra', 'placeholder' => 'Párrafo']) !!}
			</div>
			@endif
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