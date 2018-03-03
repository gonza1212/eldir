@extends('layouts.app')

@section('title', 'Ajustar Meta')

@include('layouts.errores')

@section('content')
<div class="container size-letra container-blanco-solido">
    <div class="row">
    	<div class="col-sm-12">
	    	<div class="col-sm-10"><h3>Opciones de Metas</h3></div>
	    	<div class="col-sm-2"><a href="{{ route('ayuda.main') }}#metas"><i class="fas fa-question-circle"></i> Ayuda de <strong>Metas</strong></a></div>
    	</div>
        <div class="col-md-12">
			<hr>
			@if(\Auth::user()->meta_activa())
			<a class="btn btn-primary" href="{{ route('ajustar-meta') }}"><i class="fas fa-ban"></i> Desactivar Cálculo de Metas</a>
			<hr>
			{!! Form::model(\Auth::user(), ['route' => 'configurar-meta']) !!}
				<div class="form-group">
					{!! Form::label('condicion', 'Condición') !!}
					{!! Form::select('condicion', $condiciones, \Auth::user()->condicion, ['class' => 'form-control size-letra', 'required', 'id' => 'selectorCondicion']) !!}
				</div>
				<div class="form-group">
					{!! Form::label('meta', 'Meta') !!}
					{!! Form::number('meta', null, ['class' => 'form-control size-letra', 'placeholder' => 'Cantidad de Horas', 'required', 'id' => 'meta']) !!}
				</div>
				<div class="form-group">
					{!! Form::submit('Guardar Meta', ['class' => 'btn btn-primary size-letra']) !!}
				</div>
			{!! Form::close() !!}
			@else
			<a class="btn btn-primary" href="{{ route('ajustar-meta') }}"><i class="fas fa-check-circle"></i> Activar Cálculo de Metas</a>
			@endif
		</div>
	</div>
</div>
@endsection