@extends('layouts.app')

@section('title', 'Mi Informe')

@section('content')
<div class="container size-letra">
    <div class="row">
        <div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heanding">
					<h3 class="text-center">{!! $meses[$hoy->month] . ' de ' . $hoy->year !!}</h3>
				</div>
				<div class="panel-body text-center">
					<h3>{{ $actividadActual[0] }}<small> horas con </small>{{ $actividadActual[1] }}<small> minutos, </small>{{ $actividadActual[2] }}<small> publicaciones, </small>{{ $actividadActual[3] }}<small> videos y </small>{{ $actividadActual[4] }}<small> revisitas.</small></h3>
					<hr>
					<a class="btn btn-primary" id='collapseMesActual' data-toggle="collapse" href="#registrosActuales"><i class="fas fa-search"></i>{{ ' Ver registros de ' . $meses[$hoy->month] .' (' . count($actuales). ')' }}</a>
			        <div id="registrosActuales" class="panel-collapse collapse">
			        	<div class="table-responsive">
					<table class="table text-left">
				  <thead>
				    <tr>
				      <th scope="col">Fecha</th>
				      <th scope="col">Horas</th>
				      <th scope="col">Publicaciones</th>
				      <th scope="col">Videos</th>
				      <th scope="col">Revisitas</th>
				    </tr>
				  </thead>
				  <tbody>
				  	@foreach($actuales as $a)
				    <tr>
				      <td>{!! Carbon\Carbon::parse($a->fecha)->toFormattedDateString() !!}</td>
				      @if($a->minutos > 9)
				      <td>{{ $a->horas }}:{{ $a->minutos }}</td>
				      @else
				      <td>{{ $a->horas }}:0{{ $a->minutos }}</td>
				      @endif
				      <td>{{ $a->publicaciones }}</td>
				      <td>{{ $a->videos }}</td>
				      <td>{{ $a->revisitas }}</td>
				    </tr>
				    @endforeach
				  </tbody>
				</table>
			</div>
			</div>
				</div>
			</div>
			<div class="panel panel-default">
				<div class="panel-heanding">
					<h3 class="text-center">{!! $meses[($hoy->subMonth())->month] . ' de ' . $hoy->year !!}</h3>
				</div>
				<div class="panel-body text-center">
					<h3>{{ $actividadPasada[0] }}<small> horas con </small>{{ $actividadPasada[1] }}<small> minutos, </small>{{ $actividadPasada[2] }}<small> publicaciones, </small>{{ $actividadPasada[3] }}<small> videos y </small>{{ $actividadPasada[4] }}<small> revisitas.</small></small></h3>
					<hr>
					<a class="btn btn-primary" id='collapseMesPasado' data-toggle="collapse" href="#registrosPasados"><i class="fas fa-search"></i>{{ ' Ver registros de ' . $meses[$hoy->month] .' (' . count($pasadas). ')' }}</a>
			        <div id="registrosPasados" class="panel-collapse collapse">
			        	<div class="table-responsive">
					<table class="table text-left">
				  <thead>
				    <tr>
				      <th scope="col">Fecha</th>
				      <th scope="col">Horas</th>
				      <th scope="col">Publicaciones</th>
				      <th scope="col">Videos</th>
				      <th scope="col">Revisitas</th>
				    </tr>
				  </thead>
				  <tbody>
				  	@foreach($pasadas as $p)
				    <tr>
				      <td>{!! Carbon\Carbon::parse($p->fecha)->toFormattedDateString() !!}</td>
				      @if($p->minutos > 9)
				      <td>{{ $p->horas }}:{{ $p->minutos }}</td>
				      @else
				      <td>{{ $p->horas }}:0{{ $p->minutos }}</td>
				      @endif
				      <td>{{ $p->publicaciones }}</td>
				      <td>{{ $p->videos }}</td>
				      <td>{{ $p->revisitas }}</td>
				    </tr>
				    @endforeach
				  </tbody>
				</table>
			</div>
			</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection