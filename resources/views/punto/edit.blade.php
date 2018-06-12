@extends('layouts.app')

@section('title', 'Editar Punto')

@include('layouts.errores')

@section('content')
<div class="container size-letra">
    <div class="row">
        <div class="col-md-12">
        {!! Form::model( $punto, ['route' => ['punto.update', $punto->id], 'method' => 'PUT']) !!}
                <div class="form-group">
					{!! Form::label('fecha', 'Fecha') !!}
					{!! Form::date('fecha', \Carbon\Carbon::parse($punto->fecha), ['class' => 'form-control size-letra', 'required']) !!}
				</div>
				<div class="form-group">
					{!! Form::label('tipo', 'Tipo') !!}
					{!! Form::select('tipo', $tipos, null, ['class' => 'form-control size-letra', 'required']) !!}
				</div>
				<div class="form-group">
					{!! Form::label('direccion', 'Dirección') !!}
					{!! Form::text('direccion', null, ['class' => 'form-control size-letra', 'placeholder' => 'Calle y N°']) !!}
				</div>
				<div class="form-group">
					{!! Form::label('simbolo', 'Símbolo') !!}
					{!! Form::select('simbolo', $simbolos, null, ['class' => 'form-control size-letra', 'required']) !!}
				</div>
				<div class="form-group">
					{!! Form::label('observaciones', 'Observaciones') !!}
					{!! Form::text('observaciones', null, ['class' => 'form-control size-letra', 'placeholder' => 'Nombre, colocaciones, etc.']) !!}
				</div>
				<div class="form-group">
					{!! Form::hidden('territorio_id', $territorio_id, ['class' => 'form-control size-letra']) !!}
				</div>
				<div class="form-group">
					{!! Form::submit('Guardar Punto', ['class' => 'btn btn-primary size-letra']) !!}
				</div>
			{!! Form::close() !!}
		</div>
	</div>
</div>
@endsection