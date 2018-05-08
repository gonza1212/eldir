@extends('layouts.app')

@section('title', 'Editar Sesión de Estudio')

@section('content')
<div class="container rgba size-letra">
	<div class="row">
		<div class="col-md-12">
			@if($sesion->persona->observaciones != null)
			<h4><strong>Sesión de Estudio con {{ $sesion->persona->nombre }}</strong> ({{ $sesion->persona->observaciones }})</h4>
			@else
			<h4><strong>Sesión de Estudio con {{ $sesion->persona->nombre }}</strong></h4>
			@endif
		</div>		
		<div class="col-md-6">
			<p>{{ $sesion->persona->direccion->calle_1 . ' N°' . $sesion->persona->direccion->numero }}</p>
		</div>
	</div>
    <div class="row">
			@include('layouts.errores')
        <div class="col-md-12">
			{!! Form::model($sesion, ['route' => ['estudio.update', $sesion->id],  'method' => 'PUT']) !!}
		    <div class="form-group">
				{!! Form::date('fecha', \Carbon\Carbon::parse($sesion->fecha), ['class' => 'form-control size-letra', 'required']) !!}
			</div>
			<div class="form-group">
				{!! Form::select('publicacion', $publicaciones, substr($sesion->publicacion, 5, strrpos($sesion->publicacion, '$cap:')-5),['class' => 'form-control size-letra']) !!}
			</div>
			<div class="form-group input-group">
					<label class="input-group-text">Cap.:</label>
					{!! Form::text('cap', substr($sesion->publicacion, strrpos($sesion->publicacion, '$cap:')+5, strrpos($sesion->publicacion, '$parr:')-(strrpos($sesion->publicacion, '$cap:')+5)), ['class' => 'form-control size-letra', 'placeholder' => 'Capítulo o Lección']) !!}
					<label class="input-group-text">Párr.:</label>
					{!! Form::text('parr', substr($sesion->publicacion,  strrpos($sesion->publicacion, '$parr:')+6), ['class' => 'form-control size-letra', 'placeholder' => 'Párrafo']) !!}
				</div>
			<div class="form-group">
				{!! Form::text('obs_2', $sesion->observaciones, ['class' => 'form-control size-letra', 'placeholder' => 'Observaciones...']) !!}
			</div>
			<div class="form-group">
				{!! Form::hidden('persona_id', $sesion->persona->id, ['class' => 'form-control size-letra']) !!}
			</div>
			<div class="form-group">
				{!! Form::hidden('nombre', $sesion->persona->nombre, ['class' => 'form-control size-letra']) !!}
			</div>
			<div class="form-group">
				{!! Form::submit('Guardar', ['class' => 'btn btn-primary size-letra']) !!}
			</div>
			{!! Form::close() !!}
		</div>
	</div>
</div>
@endsection