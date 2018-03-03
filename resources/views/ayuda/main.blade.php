@extends('layouts.app')

@section('title', 'Ayuda: Sección Principal')

@section('content')
<div class="container size-letra">
    <div class="row">
        <div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					Ayuda: Sección Principal
				</div>
				<div class="panel-body">
					<div id="metas">
						<h4 class="titulo-seccion-ayuda">Opciones de Metas</h4>
						<p>Configurar una Meta permite definir un objetivo de horas que se pretende alcanzar en el mes. El sistema calculará cómo va su progreso con respecto a la meta configurada según la fecha actual y se lo mostrará tanto en la ventana de 'Inicio' como en el cálculo del informe mensual.<br><br>Puede activar y desactivar esta opción en cualquier momento.</p>
						<br>
						<a class="btn btn-primary" href="{{ route('meta') }}"><i class="fas fa-arrow-circle-left"></i> Volver a Opciones de Metas</a>
						<hr>
					</div>
					<div id="actividad-informada">
						<h4 class="titulo-seccion-ayuda">Actividad Informada</h4>
						<p>Tal vez le ha pasado que termina un mes y a la hora de informar su actividad, ve que tiene cierta cantidad de horas y algunos minutos de más. Al informar las horas que hizo, le quedaron minutos sobrantes. Si son muy pocos puede dejarlos pasar, pero si son varios tal vez quiera pasarlos al mes siguiente. Para hacer esto con 'Anotador de Actividad' existe la opción 'Actividad Informada'. Sólo debe indicar cuántas horas informó y el sistema le cargará los minutos sobrantes al mes en curso.<br><br> En el caso opuesto, si informó más horas de las que hizo (por ejemplo, hizo 19 horas de actvidad con 55 minutos e informó 20 horas), el sistema le generará un registro con la actividad que "adeuda" en el mes en curso para calcular la actividad actual teniendo en cuenta dicha deuda.<br><br>Puede indicar cuánta actividad informó el mes anterior en cualquier momento del mes en curso, pero sólo puede hacerse una vez por mes y no hay posibilidad de corrección. Si por alguna razón comete algún error en la carga de este dato, contacte con el desarrollador para que lo corrija.</p>
						<br>
						<a class="btn btn-primary" href="{{ route('informe') }}"><i class="fas fa-arrow-circle-left"></i> Volver a Informe</a>
						<hr>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection