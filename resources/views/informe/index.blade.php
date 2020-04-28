@extends('layouts.app')

@section('title', 'Mi Informe')

@section('content')
<div class="container size-letra">
    <div class="row">
        <div class="col-md-12">
			<div class="panel panel-default" style="border-radius: 0px;">
				<div class="panel-heading">
					<h3 class="text-center">{!! $meses[$mesActual->month] . ' de ' . $mesActual->year !!} <a class="btn btn-wsp font-weight-bold" href="whatsapp://send?text={{ 'Informe de *' . Auth::user()->name . '* de *' . $meses[$mesActual->month] . '*: ' . $actividadActual[0] . ' horas, ' . $actividadActual[2] . ' publicaciones ' . $actividadActual[3] . ' videos, ' . $actividadActual[4] . ' revisitas y ' . $actividadActual[5] . ' estudios (Eldir.ml)' }}" data-action="share/whatsapp/share">Compartir <i class="fab fa-whatsapp fa-lg"></i></a></h3>
				</div>
				<div class="panel-body text-center">
					<h3>{{ $actividadActual[0] }}<small> horas con </small>{{ $actividadActual[1] }}<small> minutos, </small>{{ $actividadActual[2] }}<small> publicaciones, </small>{{ $actividadActual[3] }}<small> videos, </small>{{ $actividadActual[4] }}<small> revisitas y </small>{{ $actividadActual[5] }}<small> estudios.</small></h3>
					<hr>
                        @if(\Auth::user()->meta_activa())
                            <h4 class="size-letra">Mi meta para este mes era de <strong>{{ \Auth::user()->meta }} hrs.</strong></h4>
                            @php
                            $fecha = \Carbon\Carbon::now();
                            $min_dia = (\Auth::user()->meta * 60) / $fecha->daysInMonth;
                            $horas_deber = intdiv($min_dia * $fecha->day, 60);
                            $min_deber = ($min_dia * $fecha->day) % 60;
                            if($actividadActual[0] >= \Auth::user()->meta) {
                                @endphp
                                <h3 class="text-success font-weight-bold"><i class="far fa-smile fa-lg fa-spin"></i> ¡¡¡Cumplí mi meta!!! <i class="far fa-smile fa-lg fa-spin" data-fa-transform="rotate-90"></i></h3>
                                @php
                            }
                            else if($actividadActual[0] > $horas_deber || $actividadActual[0] == $horas_deber && $actividadActual[1] >= $min_deber) {
                                @endphp
                                <h3 class="text-success font-weight-bold"><i class="far fa-thumbs-up"></i> ¡Voy en camino a cumplir la meta! <i class="fas fa-child"></i></h3>
                                @php
                            } else {
                                @endphp
                                <h3 class="text-danger">Mmmm... parece que no llego <i class="far fa-thumbs-down"></i></h3>
                                @php
                            }
                            @endphp
                            <hr>
                        @endif
					<a class="btn btn-primary" id='collapseMesActual' data-toggle="collapse" href="#registrosActuales"><i class="fas fa-search"></i>{{ ' Ver registros de ' . $meses[$mesActual->month] .' (' . count($actuales). ')' }}</a>
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
							      @if($a->minutos > 9 || $a->minutos < 0)
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
				<div class="panel-heading" style="border-radius: 0px;">
					<h3 class="text-center">{!! $meses[($mesActual->subMonth())->month] . ' de ' . $mesActual->year !!} <a class="btn btn-wsp font-weight-bold" href="whatsapp://send?text={{ 'Informe de *' . Auth::user()->name . '* de *' . $meses[$mesActual->month] . '*: ' . $actividadPasada[0] . ' horas, ' . $actividadPasada[2] . ' publicaciones ' . $actividadPasada[3] . ' videos, ' . $actividadPasada[4] . ' revisitas y ' . $actividadPasada[5] . ' estudios (Eldir.ml)' }}" data-action="share/whatsapp/share">Compartir <i class="fab fa-whatsapp fa-lg"></i></a></h3>
				</div>
				<div class="panel-body text-center">
					<h3>{{ $actividadPasada[0] }}<small> horas con </small>{{ $actividadPasada[1] }}<small> minutos, </small>{{ $actividadPasada[2] }}<small> publicaciones, </small>{{ $actividadPasada[3] }}<small> videos, </small>{{ $actividadPasada[4] }}<small> revisitas y </small>{{ $actividadPasada[5] }}<small> estudios.</small></h3>
					<hr>
					<a class="btn btn-primary" id='collapseMesPasado' data-toggle="collapse" href="#registrosPasados"><i class="fas fa-search"></i>{{ ' Ver registros de ' . $meses[$mesActual->month] .' (' . count($pasadas). ')' }}</a> <a class="btn btn-info"  id='collapseInformado' data-toggle="collapse" href="#informado"><i class="fas fa-pencil-alt"></i> Informado...</a>
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
					<div id="informado" class="panel-collapse collapse">
						<hr>
						@if(count($pasadas))
							@if(count($informe))
								<label>Este mes se informaron {{ $informe[0]->horas_informadas }} horas.</label>
							@else
								{!! Form::open(['route' => 'pasar-actividad']) !!}
								<div class="form-group">
									{!! Form::label('informado', 'Actividad Informada - ') !!}
									<a href="{{ route('ayuda.main') }}#actividad-informada"><i class="fas fa-question-circle"></i> ¿Qué es <strong>esto</strong>?</a>
									{!! Form::number('informado', null, ['class' => 'form-control size-letra', 'placeholder' => 'Cantidad de Horas', 'required', 'id' => 'informado']) !!}
									{!! Form::hidden('predicado_horas', $actividadPasada[0], ['class' => 'form-control']) !!}
									{!! Form::hidden('predicado_min', $actividadPasada[1], ['class' => 'form-control']) !!}
									{!! Form::hidden('informe_redactado', $actividadPasada[0].' horas con '.$actividadPasada[1].' minutos, '.$actividadPasada[2].' publicaciones, '.$actividadPasada[3].' videos,  '.$actividadPasada[4].' revisitas y '.$actividadPasada[5].' estudios.', ['class' => 'form-control']) !!}
								</div>
								<div class="form-group">
									{!! Form::submit('Guardar', ['class' => 'btn btn-primary size-letra']) !!}
								</div>
								{!! Form::close() !!}
							@endif
						@else
							<label>No hay actividad para informar.</label>
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection