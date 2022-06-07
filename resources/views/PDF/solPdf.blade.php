<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Solicitud</title>
        <style type="text/css">
        	table td{
        		text-align: center;
        	}
        	h2{
        		text-align: center;
        		margin-bottom: 100px;
        	}
        </style>
</head>
<body>
	<div class="container">
		<div class="card-body bg-white">
			<div class="row">
				<div class="col-12">
					<div class="card card-danger">
			            <div class="card-header">
			            	<h2 class="card-title">Solicitud</h2>
			            </div>

			            <table class="bordered" width="100%">
			            		<tr>
			            			<th>ID</th>
			            			<th>Fecha</th>
			            			<th>Almacen Origen</th>
			            			<th>Almacen Destino</th>
			            		</tr>
			            		<tr>
				            		<td>{{$solicitud->id_solicitud}}</td>
				            		<td>{{$solicitud->fecha_solicitud}}</td>
				            		<td>{{$solicitud->almaor}}</td>
				            		<td>{{$solicitud->almade}}</td>
				            	</tr>
				            	<br>
				            	<br>
				            	<tr>
				            		<th>Estatus Solicitud</th>
				            		<th>Material</th>
				            		<th>Disponible</th>
				            		<th>Cantidad Solicitada</th>
				            	</tr>
				            	<tr>
				            		<td>{{$solicitud->estatus_solicitud}}</td>
				            		<td>{{$solicitud->nombre_material}}</td>
				            		<td>{{$solicitud->stock}}</td>
				            		<td>{{$solicitud->cantidad}}</td>
				            	</tr>
				            	<tr>
				            		<th colspan="4">Observaciones</th>
				            	</tr>
				            	<tr>
				            		<td colspan="4">{{$solicitud->observaciones}}</td>
				            	</tr>
			            </table>

			            <br><br><br>
			        </div>
			    </div>
			</div>
		</div>
	</div>
</body>
</html>