@extends('layouts.app')

@section('title', 'Error 401: Acceso Denegado')

@section('content')
<div class="container size-letra">
    <div class="row">
        <div class="col-md-12">
			<div class="text-center">
			<p align="middle">
				<img src="{{ asset('images/401.jpeg') }}" class="img-responsive" width="50%" height="50%"></p>
			<h2>Ups! No tienes acceso a este panel de Administración</h2>
			<a href="{!! route('home') !!}">Volver al inicio</a>
			</div>
		</div>
	</div>
</div>
@endsection