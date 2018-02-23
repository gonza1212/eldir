@extends('layouts.app')

@section('title', 'Editar Usuario ' . $user->name)

@include('layouts.errores')

@section('content')
<div class="container size-letra">
    <div class="row">
        <div class="col-md-12">
			{!! Form::model($user, ['route' => ['users.update', $user->id], 'method' => 'PUT']) !!}
			<div class="form-group">
				{!! Form::label('name', 'Nombre') !!}
				{!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nombre completo', 'required']) !!}
			</div>
			<div class="form-group">
				{!! Form::label('email', 'Email') !!}
				{!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'example@gmail.com', 'required']) !!}
			</div>
			<div class="form-group">
				{!! Form::label('type', 'Tipo') !!}
				{!! Form::select('type', ['member' => 'Miembro', 'admin' => 'Administrador'], null, ['class' => 'form-control']) !!}
			</div>
			<div class="form-group">
				{!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
			</div>
			{!! Form::close() !!}
		</div>
	</div>
</div>
@endsection