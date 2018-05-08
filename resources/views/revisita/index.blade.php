@extends('layouts.app')

@section('title', 'Lista de Revisitas')

@section('content')
<div class="container size-letra">
    <div class="row">
        <div class="col-md-12">
			<div class="d-none d-sm-block">
        		<a href="{{ route('visita.create') }}" class="btn btn-primary"><i class="fas fa-address-book"></i> Cargar Visita Inicial</a>
				<a href="{{ route('persona.index') }}" class="btn btn-primary"><i class="fas fa-th-large"></i> Ver Revisitas como Bloques</a>
        	</div>
        	<div class="d-md-none d-lg-none d-xl-none d-sm-none">
				<a href="{{ route('visita.create') }}" class="btn btn-primary"><i class="fas fa-address-book"></i> Visita Inicial</a>
				<a href="{{ route('persona.index') }}" class="btn btn-primary"><i class="fas fa-th-large"></i> Ver como Bloques</a>
			</div>
			<br>
			<hr>
			<div class="table-responsive rgba">
				<table class="table">
				  <thead>
				    <tr>
				      <th>Nombre</th>
				      <th>Dirección</th>
				      <th>Últ. Visita</th>
				      <th>Tema</th>
				      <th>Pendiente</th>
				      <th>Opciones</th>
				    </tr>
				  </thead>
				  <tbody>
				  	@foreach($personas as $p)
				    <tr>
				      <td>{{ $p->nombre }}</td>
				      <td>{{ $p->direccion->calle_1 . ' N° ' . $p->direccion->numero }}</td>
				      @if(count($p->visitas) > 0)
							<td>{!! Carbon\Carbon::parse($p->visitas[count($p->visitas) - 1]->fecha)->toFormattedDateString() !!}</td>
							<td>{{ $p->visitas[count($p->visitas) - 1]->tema }}</td>
							<td>{{ $p->visitas[count($p->visitas) - 1]->pendiente }}</td>
						@else
						<td>S/ Visitas</td>
						<td>S/ Visitas</td>
						<td>S/ Visitas</td>
						@endif
				      <td><a class="btn btn-primary btn-sm" href="{{ route('revisita.create', $p->id) }}"><i class="fas fa-plus"></i> Rev.</a></td>
				    </tr>
				    @endforeach
				  </tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection