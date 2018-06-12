@extends('layouts.app')

@section('title', 'Ayuda: Sección Principal')

@section('content')
<div class="container size-letra">
    <div class="row">
        <div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading text-center">
					<strong>Ayuda - Sección Principal</strong>
				</div>
				<div class="panel-body">
					<div id="indice">
						<br><br><br>
						<h5><strong>Índice</strong></h5>
						<ul>
							<li><a class="a-indice" class="text-success" href="#actividad-informada">Actividad Informada</a></li>
							<li><a class="a-indice" href="#carencias">Carencias del sistema</a></li>
							<li><a class="a-indice" href="#estudios">Estudios</a></li>
							<li><a class="a-indice" href="#metas">Metas</a></li>
							<li><a class="a-indice" href="#revisitas">Revisitas</a></li>
						</ul>
					</div>
					<div id="actividad-informada">
						<br><br><br>
						<h4 class="titulo-seccion-ayuda">Actividad Informada</h4>
						<p>Tal vez le ha pasado que termina un mes y a la hora de informar su actividad, ve que tiene cierta cantidad de horas y algunos minutos de más. Al informar las horas que hizo, le quedaron minutos sobrantes. Si son muy pocos puede dejarlos pasar, pero si son varios tal vez quiera pasarlos al mes siguiente. Para hacer esto con 'Anotador de Actividad' existe la opción 'Actividad Informada'. Sólo debe indicar cuántas horas informó y el sistema le cargará los minutos sobrantes al mes en curso.<br><br> En el caso opuesto, si informó más horas de las que hizo (por ejemplo, hizo 19 horas de actvidad con 55 minutos e informó 20 horas), el sistema le generará un registro con la actividad que "adeuda" en el mes en curso para calcular la actividad actual teniendo en cuenta dicha deuda.<br><br>Puede indicar cuánta actividad informó el mes anterior en cualquier momento del mes en curso, pero sólo puede hacerse una vez por mes y no hay posibilidad de corrección. Si por alguna razón comete algún error en la carga de este dato, contacte con el desarrollador para que lo corrija.</p>
						<br>
						<div class="d-none d-sm-block">
							<a class="btn btn-primary" href="{{ route('informe') }}"><i class="fas fa-arrow-circle-left"></i> Volver a Informe</a><a class="btn btn-info" href="#indice"><i class="fas fa-arrow-circle-up"></i> Volver al Índice</a>
						</div>
						<div class="d-md-none d-lg-none d-xl-none d-sm-none">
							<a class="btn btn-primary" href="{{ route('informe') }}"><i class="fas fa-arrow-circle-left"></i> Informe</a><a class="btn btn-info" href="#indice"><i class="fas fa-arrow-circle-up"></i> Índice</a>
						</div>
						<hr>
					</div>
					<div id="carencias">
						<br><br><br>
						<h4 class="titulo-seccion-ayuda">Carencias del sistema</h4>
						<p>Como el sistema aún se encuentra en desarrollo, aún hay muchas cosas por agregar (historial de actividad, personalizacion de colores, pasar revisitas a otros usuarios, etc.). A medida que vaya pasando el tiempo y pueda recibir opiniones de los usuarios, se irán agregando mejoras.<br><strong>Pronto se incluirá una opción para enviarle mensajes al desarrollador desde el mismo sistema, sobre posibles mejoras o errores encontrados.</strong></p>
						<br>
						<div class="d-none d-sm-block">
							<a class="btn btn-primary" href="{{ route('home') }}"><i class="fas fa-arrow-circle-left"></i> Volver al Inicio</a><a class="btn btn-info" href="#indice"><i class="fas fa-arrow-circle-up"></i> Volver al Índice</a>
						</div>
						<div class="d-md-none d-lg-none d-xl-none d-sm-none">
							<a class="btn btn-primary" href="{{ route('home') }}"><i class="fas fa-arrow-circle-left"></i> Inicio</a><a class="btn btn-info" href="#indice"><i class="fas fa-arrow-circle-up"></i> Índice</a>
						</div>
						<hr>
					</div>
					<div id="estudios">
						<br><br><br>
						<h4 class="titulo-seccion-ayuda">Estudios</h4>
						<p><strong>1- ¿Cómo cargo un estudio?</strong><br>Para indicarle al sistema que una persona es un estudiante de la Biblia, hay un botón de color verde llamado Estudio. Al tocarlo, el sistema configura a la persona como un estudiante de la Biblia. Esto habilita la opción de cargar una sesión de estudio. La carga simplifica algunos datos, asumiendo que se utilizará alguna publicación del kit de enseñanza y brinda campos para cargar fácilmente el capítulo o lección y el párrafo que se estudió. En caso de que se deje alguna pregunta pendiente o haya algo que agregar, se deja abierto el campo Observaciones para tal fin. Cada sesión de estudio se cuenta como una revisita (Organizados pág. 75 cap. 8 párr. 25).</p>
						<p><strong>2- ¿Cómo cuenta el sistema los estudios?</strong><br>Aunque uno pudiera configurar a muchas personas como estudiantes de la Biblia, el sistema sólo contabilizará como Estudio a aquella persona a la que se la haya dirigido por lo menos una sesión de estudio durante el mes. Aunque se hayan hecho muchas revisitas a una persona pero no se le haya dirigido ninguna sesión de estudio durante el mes en curso, el sistema no lo contará como Estudio (Organizados pág. 75 cap. 8 párr. 26).</p>
						<p><strong>3- ¿Qué pasa si un estudiante deja de estudiar?</strong><br>Tal como se puede indicar que una persona estudia la Biblia, de la misma forma se puede indicar que ha abandonado el estudio. El botón para hacerlo se encuentra en la ventana que muestra los detalles de una persona. Dado que el sistema contabiliza en el informe como estudios a quienes se les dirigió por lo menos una sesión durante el mes, este cambio no afecta a tal cálculo en ninguna forma. En otras palabras, si se le dirigió una o más sesiones de estudio a una persona en un mes y luego deja de estudiar en el mismo mes, el sistema contará las sesiones realizadas como revisitas y contará 1 (un) estudio durante el mes. Si en el próximo mes no se vuelve a dirigir una sesión de estudio, ya no se contará como tal.</p>
						<br>
						<div class="d-none d-sm-block">
							<a class="btn btn-primary" href="{{ route('persona.index') }}"><i class="fas fa-arrow-circle-left"></i> Volver a Personas Interesadas</a><a class="btn btn-info" href="#indice"><i class="fas fa-arrow-circle-up"></i> Volver al Índice</a>
						</div>
						<div class="d-md-none d-lg-none d-xl-none d-sm-none">
							<a class="btn btn-primary" href="{{ route('persona.index') }}"><i class="fas fa-arrow-circle-left"></i> Personas Interesadas</a><a class="btn btn-info" href="#indice"><i class="fas fa-arrow-circle-up"></i> Índice</a>
						</div>
						<hr>
					</div>
					<div id="metas">
						<br><br><br>
						<h4 class="titulo-seccion-ayuda">Opciones de Metas</h4>
						<p>Configurar una Meta permite definir un objetivo de horas que se pretende alcanzar en el mes. El sistema calculará cómo va su progreso con respecto a la meta configurada según la fecha actual y se lo mostrará tanto en la ventana de 'Inicio' como en el cálculo del informe mensual.<br><br>Puede activar y desactivar esta opción en cualquier momento.</p>
						<br>
						<div class="d-none d-sm-block">
							<a class="btn btn-primary" href="{{ route('meta') }}"><i class="fas fa-arrow-circle-left"></i> Volver a Opciones de Metas</a><a class="btn btn-info" href="#indice"><i class="fas fa-arrow-circle-up"></i> Volver al Índice</a>
						</div>
						<div class="d-md-none d-lg-none d-xl-none d-sm-none">
							<a class="btn btn-primary" href="{{ route('meta') }}"><i class="fas fa-arrow-circle-left"></i> Opciones de Metas</a><a class="btn btn-info" href="#indice"><i class="fas fa-arrow-circle-up"></i> Índice</a>
						</div>
						<hr>
					</div>
					<div id="revisitas">
						<br><br><br>
						<h4 class="titulo-seccion-ayuda">Revisitas</h4>
						<p>El sistema permite cargar revisitas de dos formas: informando sólo la cantidad al crear un registro de actividad o cargando los datos de una persona, su dirección y los datos propios de la visita.<br>Las publicaciones o videos cargados en esta sección aún no se contabilizan en el informe, por lo que deben ser cargados en el registro de Actividad.</p>
						<p><strong>1- Para cargar una revisita con los datos de la persona:</strong><br>Entrar a la sección Personas Interesadas y luego en el botón Cargar Visita Inicial o directamente desde + Actividad en la vista de Inicio. Allí se deben cargar como datos obligatorios: Fecha y Nombre de la persona, todo lo demás es opcional y existe la posibilidad de completarlo después. Los botones +Persona, +Dirección y +Visita permiten acceder a más campos opcionales para cargar aún más detalles. Se puede cargar un total de 21 datos diferentes.</p>
						<p><strong>2- ¿Cómo edito los datos de una persona?</strong><br>Al ingresar en la sección Personas Interesadas, se listan las personas cargadas en el sistema. Si se hace click en el nombre de la persona se ingresará a una ventana donde se detallan los datos y las opciones para las personas cargads. En caso de haberse cargado el número de eléfono y usar el sistema desde un celular, se puede llamar sólo con tocar el número. Lo mismo sucede con el correo electrónico. Entre las opciones disponibles, están los botones para editar los datos de una persona o su dirección.</p>
						<p><strong>3- ¿Cómo elimino los registros de una persona?</strong><br>A diferencia de otros registros, los datos de una persona se consideran Datos Importantes. Dado que se puede haber hecho revisitas a una persona y luego, por alguna razón, desear eliminar su registro, cabe la posibilidad de perder las revisitas y que el sistema no las cuente. Para evitar este problema, el sistema no elimina completamente a una persona hasta haberse asegurado de haber contado las revisitas que se le realizaron en el informe correspondiente. Luego de haberse confeccionado el informe, la persona será eliminada.</p>
						<p><strong>4- ¿Cómo edito o elimino los datos de una visita?</strong><br>En la misma ventana donde se ven los detalles de una persona, se listan las revisitas y las sesiones de estudio en forma de "acordeón", es decir, que para ver los detalles de una visita en particular debe hacerse click en la fecha. Dentro de los detalles de cada visita o sesión de estudio están las opciones para editarlas o eliminarlas.</p>
						<p><strong>5- ¿Cómo cuenta las revisitas el sistema?</strong><br>Cuenta tanto las revisitas cargadas como número desde los registros de actividad, como las visitas realizadas a personas cargadas en el sistema. Ya que una revisita se cuenta cuando se visitó por segunda vez a una persona, la visita inicial se pasa por alto y no cuenta como revisita. Además se cuentan todas las sesiones de estudio realizadas durante el mes (Organizados pág. 75 cap. 8 párr. 25). Debido a esto, <strong>no deberían cargarse las visitas a una persona y, además, cargar el número en el registro de actividad</strong>, esto ocasionaría que el sistema sume revisitas por demás. Cargue las revisitas desde un sólo lugar, sea cómo número o utilizando las herramientas para gestionar las personas interesadas pero no las dos, para evitar problemas de conteo.</p>
						<p><strong>6- ¿Cómo cargo revisitas que tenía desde antes de utilizar el sistema?</strong><br>Cuando se cargan los datos de una persona y su dirección, como también los datos de la visita, el sistema asume que es una visita inicial, por lo que la etiqueta como tal y la pasa por alto al contar las revisitas. En el caso de que ya tenga una revisita y quiera que el sistema la cuente como tal, existe la opción de configurar la visita como una Revisita y no como una visita inicial. Esta opción se encuentra justo al lado de la fecha de la visita.</p>
						<p><strong>7- Si le predico a un familiar de una revisita ¿puedo utilizar la dirección de esa revisita para no tener que cargarlos otra vez?</strong><br>Sí. El sistema brinda la opción de utilizar direcciones ya cargadas y que pertenezcan a otras revisitas. Para ello hay una lista desplegable oculta tras el botón Usar Dirección Existente. Se listan las direcciones y entre paréntesis a quién pertenece. Al tocar en el botón a la derecha de la dirección, ésta se cargará automáticamente en los campos de dirección.</p>
						<br>
						<div class="d-none d-sm-block">
							<a class="btn btn-primary" href="{{ route('persona.index') }}"><i class="fas fa-arrow-circle-left"></i> Volver a Personas Interesadas</a><a class="btn btn-info" href="#indice"><i class="fas fa-arrow-circle-up"></i> Volver al Índice</a>
						</div>
						<div class="d-md-none d-lg-none d-xl-none d-sm-none">
							<a class="btn btn-primary" href="{{ route('persona.index') }}"><i class="fas fa-arrow-circle-left"></i> Personas Interesadas</a><a class="btn btn-info" href="#indice"><i class="fas fa-arrow-circle-up"></i> Índice</a>
						</div>
						<hr>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection