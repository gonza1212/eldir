@extends('layouts.app')

@section('title', 'Cargar Visita Inicial')

@section('content')
<div class="container rgba size-letra">
    <div class="row">
        @include('layouts.errores')
        <div class="col-md-12">
        	{!! Form::open(['route' => 'visita.store', 'name' => 'inicial']) !!}
        	<h4><strong>Datos de la Persona</strong></h4>
    		<div class="form-group">
				{!! Form::text('nombre', null, ['class' => 'form-control size-letra', 'required', 'placeholder' => 'Nombre y Apellido']) !!}
			</div>
			<div class="form-group input-group">
				{!! Form::text('calle_1', null, ['class' => 'form-control size-letra', 'placeholder' => 'Calle']) !!}
				<label class="input-group-text"> N° </label>
				{!! Form::number('numero', null, ['class' => 'form-control size-letra', 'placeholder' => 'Altura o N° de Casa']) !!}
			</div>
			<div class="text-center form-group d-none d-sm-block">
				<a class="btn btn-info btn-sm" id='collapsePersona' data-toggle="collapse" href="#persona">Más datos de Persona</a>
			</div>
            <div class="text-center form-group d-md-none d-lg-none d-xl-none d-sm-none">
            	<a class="btn btn-info btn-sm" id='collapsePersona' data-toggle="collapse" href="#persona">+ Persona</a>
            </div>
            <div id="persona" class="panel-collapse collapse">
            	<div class="form-group input-group">
					{!! Form::number('edad', null, ['class' => 'form-control size-letra', 'placeholder' => 'Edad aproximada']) !!}
					<label class="input-group-text">Tel:</label>
					{!! Form::text('tel', null, ['class' => 'form-control size-letra', 'placeholder' => 'Ej: 2804000111']) !!}
				</div>
				<div class="form-group">
					{!! Form::text('email', null, ['class' => 'form-control size-letra', 'placeholder' => 'Email']) !!}
				</div>
				<div class="form-group">
					{!! Form::text('obs', null, ['class' => 'form-control size-letra', 'placeholder' => 'Observaciones...']) !!}
				</div>
				<hr style="border: 1px solid #bbbbbb;">
			</div>
			<div class="text-center form-group d-none d-sm-block">
				<a class="btn btn-info btn-sm" id='collapseDireccion' data-toggle="collapse" href="#direccion">Más datos de Dirección</a>
				<a class="btn btn-info btn-sm" id='collapseExistente' data-toggle="collapse" href="#existente">Usar Dirección Existente</a>
			</div>
            <div class="text-center form-group d-md-none d-lg-none d-xl-none d-sm-none">
            	<a class="btn btn-info btn-sm" id='collapseDireccion' data-toggle="collapse" href="#direccion">+ Dirección</a>
            	<a class="btn btn-info btn-sm" id='collapseExistente' data-toggle="collapse" href="#existente">Usar Existente</a>
            </div>
            <div id="direccion" class="panel-collapse collapse">
            	<div class="form-group">
					{!! Form::text('barrio', null, ['class' => 'form-control size-letra', 'placeholder' => 'Barrio']) !!}
				</div>
				<div class="form-group input-group">
					{!! Form::number('depto', null, ['class' => 'form-control size-letra', 'placeholder' => 'N° dpto.']) !!}
					<label class="input-group-text"> - </label>
					{!! Form::number('territorio', null, ['class' => 'form-control size-letra', 'placeholder' => 'N° Territorio']) !!}
				</div>
				<div class="form-group">
					{!! Form::label('fecha', '¿La casa queda en una esquina?') !!}
					{!! Form::text('calle_2', null, ['class' => 'form-control size-letra', 'placeholder' => 'Calle secundaria']) !!}
				</div>
				{!! Form::label('entre_a', '¿La casa no tiene N°?') !!}
				<div class="form-group input-group">
					<label class="input-group-text">Entre:</label>
					{!! Form::text('entre_a', null, ['class' => 'form-control size-letra', 'placeholder' => 'Calle A']) !!}
					<label class="input-group-text"> y </label>
					{!! Form::text('entre_b', null, ['class' => 'form-control size-letra', 'placeholder' => 'Calle B']) !!}
				</div>
				<div class="form-group">
					{!! Form::label('obs_3', '¿Algo distintivo de la casa para ubicarla mejor?') !!}
					{!! Form::text('obs_3', null, ['class' => 'form-control size-letra', 'placeholder' => 'Observaciones...']) !!}
				</div>
				<hr style="border: 1px solid #bbbbbb;">
            </div>
            <div id="existente" class="panel-collapse collapse">
            	@foreach($direcciones as $d)
            	<div class="row">
            		<div class="col-9" style="padding-left: 1em;">
            			<p>{{ $d->calle_1 }} N° {{ $d->numero }} ({{ $d->persona->nombre }})</p>
            		</div>
            		<div class="col-3 text-center">            			
            			<a class="btn btn-info btn-sm" href="javascript:llenarFormDireccion({{$d->id}})"><i class="fas fa-check-circle"></i></a>
            		</div>
            	</div>
            	@endforeach
            	<hr style="border: 1px solid #bbbbbb;">
            </div>
            @php
            $tipos = array('Inicial' => 'Inicial', 'Revisita' => 'Revisita');
            @endphp
			<h4><strong>Datos de la Visita</strong></h4>
			<div class="form-group input-group">
				{!! Form::date('fecha', \Carbon\Carbon::now(), ['class' => 'form-control size-letra', 'required']) !!}
				<label class="input-group-text">Tipo:</label>
				{!! Form::select('tipo', $tipos, $tipos['Inicial'], ['class' => 'form-control size-letra', 'required']) !!}
			</div>
			<div class="form-group">
				{!! Form::text('tema', null, ['class' => 'form-control size-letra', 'placeholder' => 'Tema hablado']) !!}
			</div>
			<div class="form-group">
				{!! Form::text('textos', null, ['class' => 'form-control size-letra', 'placeholder' => 'Textos leídos']) !!}
			</div>
			<div class="text-center form-group d-none d-sm-block">
				<a class="btn btn-info btn-sm" id='collapseVisita' data-toggle="collapse" href="#visita">Más datos de Visita</a>
			</div>
            <div class="text-center form-group d-md-none d-lg-none d-xl-none d-sm-none">
            	<a class="btn btn-info btn-sm" id='collapseVisita' data-toggle="collapse" href="#visita">+ Visita</a>
            </div>
			<div id="visita" class="panel-collapse collapse">
				<div class="form-group">
					{!! Form::text('publicacion', null, ['class' => 'form-control size-letra', 'placeholder' => 'Publicación dejada']) !!}
				</div>
				<div class="form-group">
					{!! Form::text('pendiente', null, ['class' => 'form-control size-letra', 'placeholder' => 'Tema o pregunta pendiente']) !!}
				</div>
				<div class="form-group">
					{!! Form::text('obs_2', null, ['class' => 'form-control size-letra', 'placeholder' => 'Observaciones...']) !!}
				</div>
			</div>
			<div class="form-group">
				{!! Form::submit('Guardar', ['class' => 'btn btn-primary size-letra']) !!}
			</div>
			{!! Form::close() !!}
		</div>
		<p id="prueba"></p>
	</div>
</div>
<script>
	function llenarVentana() {}

	function llenarFormDireccion(id) {
		var direcciones = <?php echo json_encode($direcciones);?>;
		var elegida = 0;
		for(var i=0; i<direcciones.length; i++) {
			if(direcciones[i]['id'] == id) {
				elegida = i;
			} 
		}
		document.inicial.calle_1.value = direcciones[elegida]['calle_1'];
		document.inicial.numero.value = direcciones[elegida]['numero'];
		document.inicial.calle_2.value = direcciones[elegida]['calle_2'];
		document.inicial.barrio.value = direcciones[elegida]['barrio'];
		document.inicial.depto.value = direcciones[elegida]['depto'];
		document.inicial.territorio.value = direcciones[elegida]['territorio'];
		document.inicial.entre_a.value = direcciones[elegida]['entre'].substr(0, direcciones[elegida]['entre'].search(' y '));
		document.inicial.entre_b.value = direcciones[elegida]['entre'].substr(direcciones[elegida]['entre'].search(' y ') + 3);
		document.inicial.obs_3.value = direcciones[elegida]['observaciones'];
	}
</script>
@endsection