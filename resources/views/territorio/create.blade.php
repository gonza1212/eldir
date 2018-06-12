@extends('layouts.app')

@section('title', 'Crear Territorio Personal')

@include('layouts.errores')

@section('content')
<div class="container rgba size-letra">
    <div class="row">
        <div class="col-md-12">
			{!! Form::open(['route' => 'territorio.store']) !!}
				<div class="form-group">
					{!! Form::label('nombre', 'Nombre o N°') !!}
					{!! Form::text('nombre', null, ['class' => 'form-control size-letra', 'placeholder' => 'Nombre o N°', 'required']) !!}
				</div>
				<div class="form-group">
					{!! Form::label('observaciones', 'Observaciones') !!}
					{!! Form::text('observaciones', null, ['class' => 'form-control size-letra', 'placeholder' => 'Edificio, lista telefónica, etc.']) !!}
				</div>
				<div class="form-group">
					{!! Form::submit('Guardar', ['class' => 'btn btn-primary size-letra']) !!}
				</div>
				{!! Form::close() !!}
		</div>
	</div>
</div>
@endsection
