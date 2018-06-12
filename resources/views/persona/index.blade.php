@extends('layouts.app')

@section('title', 'Personas Interesadas')

@section('content')
<div class="container size-letra">
    <div class="row">
        <div class="col-md-12">
        	<div class="d-none d-sm-block">
        		<a href="{{ route('visita.create') }}" class="btn btn-primary"><i class="fas fa-address-book"></i> Cargar Visita Inicial</a>
        	</div>
        	<div class="d-md-none d-lg-none d-xl-none d-sm-none">
				<a href="{{ route('visita.create') }}" class="btn btn-primary"><i class="fas fa-address-book"></i> Visita Inicial</a>
				<a href="{{ route('revisita.index') }}" class="btn btn-primary"><i class="fas fa-list-ol"></i> Ver como Lista</a>
			</div>
			<div id="buscador" class="input-group mb-3" style="margin-top: 8px;">
				<input id="barra-busqueda" type="text" class="form-control" placeholder="Nombre, Calle, Observación, etc..." aria-label="Nombre, Calle, Observación, etc..." aria-describedby="basic-addon2">
				<div class="input-group-append">
					<button class="btn btn-info" type="button" onclick="buscar()" style="font-size: normal !important;"><i class="fas fa-search"></i></button>
				</div>
			</div>
			<div id="error"></div>
			<hr>
		</div>
			@foreach($personas as $p)
			<div class="col-sm-4" id="persona_{{ $p->id }}" style="display: none;">
				<div class="panel panel-default">
					<div class="panel-heading">
						@php
						$revisitas = 0;
						foreach($p->visitas as $v) {
							if($v->isRevisita()) {
								$revisitas++;
							}
						}
						@endphp
						@if($p->isEstudio())
						<a class="link-persona-index" href="{{ route('persona.show', $p->id) }}"><strong>{{ $p->nombre }} - Estudio</strong></a> 
						@elseif($revisitas > 0)
						<a class="link-persona-index" href="{{ route('persona.show', $p->id) }}"><strong>{{ $p->nombre }}</strong></a> ({{ $revisitas }} revisita/s)
						@else
						<a class="link-persona-index" href="{{ route('persona.show', $p->id) }}"><strong>{{ $p->nombre }}</strong></a>
						@endif
					</div>
					<div class="panel-body">
						<p>Dirección: {{ $p->direccion->calle_1 . ' N° ' . $p->direccion->numero }}</p>
						<a class="btn btn-danger btn-sm" href="{{ route('persona.mapa', $p->id) }}" style="margin: -9px 0px 9px 0px !important;"><i class="fas fa-map-marker-alt"></i> Ver Mapa</a>
						@if(count($p->visitas) > 0)
							<p>Última visita: <strong>{!! Carbon\Carbon::parse($p->visitas[count($p->visitas) - 1]->fecha)->toFormattedDateString() !!}</strong></p>
							<p>Tema Hablado: {{ $p->visitas[count($p->visitas) - 1]->tema }}</p>
							<p>Pendiente: {{ $p->visitas[count($p->visitas) - 1]->pendiente }}</p>
						@endif
						@if($p->isEstudio())
						<a href="{{ route('estudio.create', $p->id) }}" class="btn btn-success btn-sm"><i class="fas fa-graduation-cap"></i> Sesión</a>
						@endif
						<a class="btn btn-primary btn-sm" href="{{ route('revisita.create', $p->id) }}"><i class="fas fa-plus"></i> Revisita</a>
					</div>
				</div>
			</div>
			@endforeach			
	</div>
</div>
<script>
	function llenarVentana() {
		var personas=<?php echo json_encode($personas);?>;
		for(var i=0; i<personas.length; i++) {
			document.getElementById('persona_' + personas[i]['id']).style = 'display: initial;';
		}
	}
	function buscar() {
		/* personas[N° persona]['visitas' o 'direccion'][N° visita - nada si es direccion]['campo de dato'] */
		var personas=<?php echo json_encode($personas);?>;
		var patron = String(document.getElementById('barra-busqueda').value).toLowerCase();
		if(patron.length == 0) {
			llenarVentana();
			return;
		}
		if(patron.length < 3) {
			document.getElementById('error').innerHTML = '<div class="alert alert-danger" role="alert">Por favor, introduzca 3 o más caracteres<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
			return;
		}
		document.getElementById('error').innerHTML = '';
		var encontradas = new Array();
		for(var i=0; i<personas.length; i++) {
			if(personas[i]['nombre'].toLowerCase().search(patron) >= 0 
				|| personas[i]['direccion']['calle_1'].toLowerCase().search(patron) >= 0 
				|| String(personas[i]['direccion']['numero']).toString().toLowerCase().search(patron) >= 0 
				|| personas[i]['direccion']['calle_2'] != null && personas[i]['direccion']['calle_2'].toLowerCase().search(patron) >= 0 
				|| personas[i]['direccion']['entre'].toLowerCase().search(patron) >= 0 
				|| personas[i]['observaciones'] != null && personas[i]['observaciones'].toLowerCase().search(patron) >= 0 
				|| personas[i]['direccion']['observaciones'] != null && personas[i]['direccion']['observaciones'].toLowerCase().search(patron) >= 0 
				|| patronEnVisitas(personas[i]['visitas'], patron)) {
					encontradas.push(personas[i]);
			}
		}
		for(var i=0; i<personas.length; i++) {
			document.getElementById('persona_' + personas[i]['id']).style = 'display: none;';
		}
		for(var i=0; i<encontradas.length; i++) {
			document.getElementById('persona_' + encontradas[i]['id']).style = 'display: initial;';
		}
	}
	function patronEnVisitas(visitas, patron) {
		for(var i=0; i<visitas.length; i++) {
			if(String(visitas[i]['tema']).toString().toLowerCase().search(patron) >= 0 
				|| String(visitas[i]['textos']).toString().toLowerCase().search(patron) >= 0 
				|| String(visitas[i]['observaciones']).toString().toLowerCase().search(patron) >= 0) {
					return true;
			}
		}
		return false;
	}
</script>
@endsection