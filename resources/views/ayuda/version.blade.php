@extends('layouts.app')

@section('title', 'Registro de Versiones')

@section('content')
<div class="panel panel-default">
	<div class="panel-heading">
		Última Versión 0.3: Cambios introducidos
	</div>
	<div class="panel-body">
		<p>
			1 - Agregadas funciones ABMC de Usuario para Admin.<br>
			2 - Arreglado bug que no permitía calcular el informe durante medianoche?...<br>
			3 - Agregado icono de aplicación.<br>
			4 - Agregadas validaciones para registrar actividad.<br>
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
@endsection