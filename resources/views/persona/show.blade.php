@extends('layouts.app')

@section('title', $persona->nombre)

@section('content')
<div class="container rgba size-letra">
    <div class="row">
        <div class="col-md-6">
			<h4><strong>{{ $persona->nombre }} ({{ $persona->edad }} años aprox.)</strong></h4>
			<hr>
			<p><a href="tel:+54{{ $persona->telefono }}">{{ $persona->telefono }} - Llamar!</a></p>
			<p><a href="mailto:{{ $persona->email }}">{{ $persona->email }} - Escribir!</a></p>
			<p>Observaciones: {{ $persona->observaciones }}</p>
		</div>
		<div class="col-md-6">
			<h5><strong>Dirección</strong></h5>
			<hr>
			<p>{{ $persona->direccion->calle_1 }} N° {{ $persona->direccion->numero }} N° dpto: {{ $persona->direccion->depto }} (entre {{ $persona->direccion->entre }})</p>
			<p>{{ $persona->direccion->calle_2 }}</p>
			<p>Barrio: {{ $persona->direccion->barrio }}</p>
			<p>N° Territorio: {{ $persona->direccion->territorio }}</p>
			<p>Observaciones: {{ $persona->direccion->observaciones }}</p>
			<div class="d-none d-sm-block">
				<a href="{{ route('revisita.create', $persona->id) }}" class="btn btn-show-revisita"><i class="fas fa-plus"></i> Revisita</a>
				@if($persona->isEstudio())
				<a href="{{ route('estudio.create', $persona->id) }}" class="btn btn-success"><i class="fas fa-graduation-cap"></i> Sesión</a>
				<a href="{{ route('estudio.cancelar', $persona->id) }}" class="btn btn-secondary"><i class="fas fa-ban"></i> Ya no es Estudio</a>
				@else
				<a href="{{ route('estudio.convertir', $persona->id) }}" class="btn btn-success"><i class="fas fa-graduation-cap"></i> Convertir a Estudio</a>
				@endif
				<a href="{{ route('persona.edit', $persona->id) }}" class="btn btn-warning"><i class="fas fa-edit"></i> Editar Info</a>
				<a href="{{ route('persona.destroy', $persona->id) }}" onclick="return confirm('¿Está seguro que desea eliminar esta persona?')" class="btn btn-danger"><i class="fas fa-trash"></i> Eliminar Persona</a>
			</div>
			<div class="d-md-none d-lg-none d-xl-none d-sm-none">
				<a href="{{ route('revisita.create', $persona->id) }}" class="btn btn-show-revisita"><i class="fas fa-plus"></i> Revisita</a>
				@if($persona->isEstudio())
				<a href="{{ route('estudio.create', $persona->id) }}" class="btn btn-success"><i class="fas fa-graduation-cap"></i> Sesión</a>
				<a href="{{ route('estudio.cancelar', $persona->id) }}" class="btn btn-secondary"><i class="fas fa-ban"></i> No estudia</a>
				@else
				<a href="{{ route('estudio.convertir', $persona->id) }}" class="btn btn-success"><i class="fas fa-graduation-cap"></i> Estudio</a>
				@endif
				<a href="{{ route('persona.edit', $persona->id) }}" class="btn btn-warning"><i class="fas fa-edit"></i> Editar</a>
				<a href="{{ route('persona.destroy', $persona->id) }}" onclick="return confirm('¿Está seguro que desea eliminar esta persona?')" class="btn btn-danger"><i class="fas fa-trash"></i> Borrar</a>
			</div>
			<br><br>
		</div>
		<div class="col-md-12" id="accordion">
			<h5 class="text-center"><strong>Visitas</strong></h5>
			@if(count($persona->visitas) > 0)
			@foreach($persona->visitas as $v)
			<div class="card">
				<div class="card-header" id="heading{{ $v->id }}">
					<h5 class="mb-0">
						<button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse{{ $v->id }}" aria-expanded="false" aria-controls="collapse{{ $v->id }}">
							{!! Carbon\Carbon::parse($v->fecha)->toFormattedDateString() !!}
							@if($v->isEstudio())
								- Sesión de Estudio
							@endif
						</button>
					</h5>
				</div>
				<div id="collapse{{ $v->id }}" class="collapse" aria-labelledby="heading{{ $v->id }}" data-parent="#accordion">
					<div class="card-body">
						@if($v->isEstudio())
						<p>Publicación estudiada: {{ $publicaciones[substr($v->publicacion, 5, strrpos($v->publicacion, '$cap:')-5)] }}</p>
						<p><strong>Se estudió hasta:</strong></p>
						<p>Capítulo (o Leccíon): {{ substr($v->publicacion, strrpos($v->publicacion, '$cap:')+5, strrpos($v->publicacion, '$parr:')-(strrpos($v->publicacion, '$cap:')+5)) }}</p>
						<p>Párrafo: {{ substr($v->publicacion,  strrpos($v->publicacion, '$parr:')+6) }}</p>
						<p>Observaciones: {{ $v->observaciones }}</p>
						<a href="{{ route('estudio.edit', $v->id) }}" class="btn btn-warning"><i class="fas fa-edit"></i> Editar Sesión</a>
						<a href="{{ route('visita.destroy', $v->id) }}" onclick="return confirm('¿Está seguro que desea eliminar esta sesión de estudio?')" class="btn btn-danger"><i class="fas fa-trash"></i> Eliminar Sesión</a>
						@else
						<p>Tema Hablado: {{ $v->tema }}</p>
						<p>Textos leídos: {{ $v->textos }}</p>
						<p>Publicación dejada: {{ $v->publicacion }}</p>
						<p>Tema Pendiente: {{ $v->pendiente }}</p>
						<p>Observaciones: {{ $v->observaciones }}</p>
						<a href="{{ route('visita.edit', $v->id) }}" class="btn btn-warning"><i class="fas fa-edit"></i> Editar Visita</a>
						<a href="{{ route('visita.destroy', $v->id) }}" onclick="return confirm('¿Está seguro que desea eliminar esta visita?')" class="btn btn-danger"><i class="fas fa-trash"></i> Eliminar Visita</a>
						@endif
					</div>
				</div>
			</div>
			@endforeach
			@else
			<h6 class="text-center">No hay visitas registradas</h6>
			@endif
		</div>
	</div>
</div>
@endsection