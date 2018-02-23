@extends('layouts.app')

@section('title', "Editar '" . $nota->titulo)

@include('layouts.errores')

@section('content')
<div class="container size-letra">
    <div class="row">
        <div class="col-md-12">
			{!! Form::model($nota, ['route' => ['notas.update', $nota->id], 'method' => 'PUT']) !!}
				<div class="form-group">
					{!! Form::label('titulo', 'Titulo') !!}
					{!! Form::text('titulo', null, ['class' => 'form-control size-letra', 'placeholder' => 'Opcional']) !!}
				</div>
				<div class="form-group">
					{!! Form::label('contenido', 'Contenido') !!}
					{!! Form::textArea('contenido', null, ['class' => 'form-control text-area-contenido size-letra', 'required', 'placeholder' => 'Escribe aquí tu nota...']) !!}
				</div>
				<div class="form-group">
					{!! Form::submit('Guardar Nota', ['class' => 'btn btn-primary size-letra']) !!}
				</div>
			{!! Form::close() !!}
		</div>
	</div>
</div>
@endsection