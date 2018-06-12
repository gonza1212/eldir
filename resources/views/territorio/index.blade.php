@extends('layouts.app')

@section('title', 'Territorio Personal')

@section('content')
<div class="container size-letra">
    <div class="row">
        <div class="col-md-12">
			<a href="{{ route('territorio.create') }}" class="btn btn-primary">Crear Territorio Personal</a>
			<br>
			<hr>
			<div class="table-responsive rgba">
				<table class="table">
				  <thead>
				    <tr>
				      <th>Territorio</th>
				      <th>Observaciones</th>
				      <th>Opciones</th>
				    </tr>
				  </thead>
				  <tbody>
				  	@foreach($territorios as $t)
				    <tr>
				      <td><a href="{{ route('territorio.show', $t->id) }}" class="aVersion">{{ $t->nombre }}</a></td>
				      <td>{{ $t->observaciones }}</td>
				      <td><a href="{{ route('territorio.edit', $t->id) }}" class="btn btn-warning"><i class="fas fa-edit"></i></a> <a href="javascript:eliminar({{ $t->id }}, 'territorio')" class="btn btn-danger"><i class="fas fa-trash"></i></a> <a href="{{ route('punto.create', $t->id) }}" class="btn btn-primary"><i class="fas fa-plus"></i></a></td>
				    </tr>
				    @endforeach
				  </tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection