@extends('layouts.app')

@section('title', 'Territorio ' . $territorio->nombre)

@section('content')
<div class="container size-letra rgba">
    <div class="row">
        <div class="col-md-12">
            <article class="text-justify territorio-personal">
            <h4>Territorio {{ $territorio->nombre }} ({{ $territorio->observaciones }})</h4>
            <p>{!! count($territorio->puntos) !!} puntos cargados.</p>
                <a href="{{ route('punto.create', $territorio->id) }}" class="btn btn-primary"><i class="fas fa-plus"></i> Punto</a>
                <a href="javascript:eliminar_agresivo({{ $territorio->id }}, '')" class="btn btn-agressive"><i class="fas fa-times-circle"></i> Borrado Agresivo</a>
            <div class="table-responsive rgba">
                <table class="table">
                <thead>
                    <tr>
                    <th>Fecha</th>
                    <th>Tipo</th>
                    <th>Dirección</th>
                    <th>Símbolo</th>
                    <th>Observaciones</th>
                    <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($territorio->puntos as $p)
                    <tr>
                    <td>{!! Carbon\Carbon::parse($p->fecha)->toFormattedDateString() !!}</td>
                    <td>{{ $p->tipo }}</td>
                    <td>{{ $p->direccion }}</td>
                    <td>{{ $p->simbolo }}</td>
                    <td>{{ $p->observaciones }}</td>
                    <td><a href="{{ route('punto.edit', $p->id) }}" class="btn btn-warning"><i class="fas fa-edit"></i></a> <a href="javascript:eliminar({{ $p->id }}, 'punto')" class="btn btn-danger"><i class="fas fa-trash"></i></a></td>
                    </tr>
                    @endforeach
                </tbody>
                </table>
            </div>
            </article>
            <small>Este formulario toma como base el S-8-S pero no lo reemplaza.</small>
		</div>
	</div>
</div>
@endsection