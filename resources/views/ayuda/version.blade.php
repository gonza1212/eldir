@extends('layouts.app')

@section('title', 'Registro de Versiones')

@section('content')
<div class="container size-letra">
    <div class="row">
        <div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h5>{{ Config::get('constants.NUM_VERSION') }} - Cambios y Mejoras</h5>
				</div>
				<div class="panel-body">
					<p>
						1 - <strong>Nueva función: Revisitas y Estudios.</strong> Se puede cargar los datos de una visita inicial, cargar revisitas nuevas o existentes, sesiones de estudio con publicacion, capítulo y párrafo, además de poder editar o eliminar cualquiera de estos datos cuando sea necesario.<br>
						2 - <strong>Buscador de Revisitas:</strong> herramienta para buscar revisitas por múltiples campos: nombre, calle, tema hablado, textos leídos u observaciones en la persona, en la dirección o en cualquiera de las visitas realizadas.<br>
						3 - Listado de Personas por urgencia de revisita: en un sólo toque uno puede saber cuáles son las revisitas a las hace mucho no se ve y hay que visitar.<br>
						4 - Actualización de Bootstrap y cambios de estilos.<br>
						5 - Cambios visuales menores.<br>
						6 - Arreglos de bugs encontrados en v1.0
					</p>
				</div>
			</div>
			<div class="panel panel-default">
				<div class="panel-heading">
					Versiones anteriores
				</div>
				<div class="panel-body">
					<div class="table-responsive">
					<table class="table">
					  <thead>
					    <tr>
					      <th scope="col">Versión</th>
					      <th scope="col">Cambios</th>
					    </tr>
					  </thead>
					  <tbody>
					  	<tr>
					      	<td>0.6</td>
					      	<td>
						      	<p>
									1 - <strong>Nueva función: Configuración de Meta mensual en horas.</strong><br>
									2 - Agregada sección de Ayuda.<br>
									3 - <strong>Nueva opción: Actividad informada</strong> (<a href="{{ route('ayuda.main') }}#actividad-informada">explicación</a>).<br>
									4 - Arreglos menores.
								</p>
							</td>
					    </tr>
					  	<tr>
					      	<td>0.5</td>
					      	<td>
						      	<p>
									1 - Se puede cargar actividad por minutos, sin tener que escribir en campo Horas.<br>
									2 - Se puede cargar una Nota con título de 3 caracteres en adelante.<br>
									3 - Agregada opción para cargar revisitas como parámetro de actividad.<br>
									4 - Agregada opción para editar un registro de actividad cargado.<br>
									5 - Arreglos menores y validaciones extra.<br>
								</p>
							</td>
					    </tr>
					  	<tr>
					      	<td>0.4.5</td>
					      	<td>
						      	<p>
									1 - Agregada opción para aumentar tamaño de letra.<br>
									2 - Cambio de ícono para informe.<br>
									3 - Arreglos menores.<br>
								</p>
							</td>
					    </tr>
					  	<tr>
					      	<td>0.4</td>
					      	<td>
						      	<p>
									1 - Cambio de tema: Azul Claro y Madera.<br>
									2 - Agregada Licencia y Autor.<br>
									3 - <strong>Nueva funcionalidad: Notas.</strong><br>
									4 - Vista Inicio renovada.<br>
								</p>
							</td>
					    </tr>
					  	<tr>
					      	<td>0.3</td>
					      	<td>
						      	<p>
									1 - <strong>Agregadas funciones ABMC de Usuario para Admin.</strong><br>
									2 - Arreglado bug que no permitía calcular el informe durante medianoche.<br>
									3 - Agregado icono de aplicación.<br>
									4 - Agregadas validaciones para registrar actividad.<br>
								</p>
							</td>
					    </tr>
					    <tr>
					      	<td>0.2</td>
					      	<td>
					      		<p>
					      			1 - Arreglado bug que mezclaba registros de actividad de un mes con otro.<br>
									2 - Arreglada distribución de tablas en resoluciones bajas.<br>
									3 - Agregados estilos CSS.<br>
									4 - Arreglados bugs menores.
								</p>
							</td>
					    </tr>
					    <tr>
							<td>0.1</td>
							<td>- Primera versión: alta del sistema.</td>
					    </tr>
					  </tbody>
					</table>		
				</div>
			</div>
			</div>
		</div>
	</div>
</div>
@endsection