@extends('layouts.app')

@section('title', 'Administración de Usuarios')

@section('content')
<a href="{{ route('users.create') }}" class="btn btn-primary">Registrar un nuevo usuario</a>
	<br>
	<hr>
	<div class="table-responsive rgba">
	<table class="table">
		<thead>
			<th>ID</th>
			<th>Nombre</th>
			<th>Email</th>
			<th>Tipo</th>
			<th>Acción</th>
		</thead>
		<tbody>
			@foreach($users as $user)
			<tr>
				<td>{{ $user->id }}</td>
				<td>{{ $user->name }}</td>
				<td>{{ $user->email }}</td>
				<td>
					@if($user->type == "admin")
						<span class="label label-danger">{{ $user->type }}</span>						
					@else
						<span class="label label-primary">{{ $user->type }}</span>
					@endif
				</td>
				<td><a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning"><i class="fas fa-edit"></i></a> <a href="{{ route('users.destroy', $user->id) }}" onclick="return confirm('¿Estás seguro que deseas eliminarlo?')" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a></td>
			</tr>
			@endforeach
		</tbody>
	</table>
	</div>
	{!! $users->render() !!}
@endsection