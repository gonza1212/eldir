@extends('layouts.app')

@section('title', $nota->titulo)

@section('content')
<div class="contenidoNota">
	<div class="row">
	    <div class="col-md-12">
	        <article class="text-justify">{!! nl2br($nota->contenido) !!}</article>
	    </div>
	</div>
	<br>
	<h4><small>Título: </small>{{ $nota->titulo }}</h4>
</div>

@endsection