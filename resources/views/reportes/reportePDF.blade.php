<div class="card">
	<div class="card-header">
		<div class="row">
			<div class="col-6">
				<h2>REPORTES GENERALES</h2>
			</div>
		</div>
	</div>
	<!-- /.card-header -->
		<div class="card-body shadow mb-4 table-responsive bg-white tabla" id="filtroTabla">
		{{-- {{dd($materiales)}} --}}
		<table class="table">
			<thead class="thead-dark">
				<tr>
					@foreach($table as $key => $value)
					@switch($value)
					@case('nombre_almacen')
					<th>Nombre Almacen</th>
					@break
					@case('siglas_almacen')
					<th>Siglas</th>
					@break
					@case('centro')
					<th>Centro</th>
					@break
					@case('nombre_familia')
					<th>Familia</th>
					@break
					@case('sum')
					<th>Stock Almacén</th>
					@break
					@case('descripcion_propuesta')
					<th>Descripción</th>
					@break
					@case('codigo')
					<th>Código</th>
					@break
					@case('unidad_medida')
					<th>Medida</th>
					@break
					@case('desc_estatus_material')
					<th>Estatus Material</th>
					@break
					@case('descrip_condicion_material')
					<th>Condición Material</th>
					@break
					@case('stock')
					<th>Stock</th>
					@break
					@endswitch
					@endforeach
				</tr>
			</thead>
			<tbody name="datos" id="datos">
					@foreach($datos as $key => $value)
				<tr>
					<th>{{$value->nombre_almacen}}</th>
					<th>{{$value->siglas_almacen}}</th>
					<th>{{$value->centro}}</th>
					<th>{{$value->nombre_familia}}</th>
					<th>{{$value->sum}}</th>
					<th>{{$value->descripcion_propuesta}}</th>
					<th>{{$value->codigo}}</th>
					<th>{{$value->unidad_medida}}</th>
					<th>{{$value->desc_estatus_material}}</th>
					<th>{{$value->descrip_condicion_material}}</th>
					<th>{{$value->stock}}</th>
				</tr>
					@endforeach

			</tbody>
			<tfoot class="thead-dark">
				
				<tr>
					@foreach($table as $key => $value)
					@switch($value)
					@case('nombre_almacen')
					<th>Nombre Almacen</th>
					@break
					@case('siglas_almacen')
					<th>Siglas</th>
					@break
					@case('centro')
					<th>Centro</th>
					@break
					@case('nombre_familia')
					<th>Familia</th>
					@break
					@case('sum')
					<th>Stock Almacén</th>
					@break
					@case('descripcion_propuesta')
					<th>Descripción</th>
					@break
					@case('codigo')
					<th>Código</th>
					@break
					@case('unidad_medida')
					<th>Medida</th>
					@break
					@case('desc_estatus_material')
					<th>Estatus Material</th>
					@break
					@case('descrip_condicion_material')
					<th>Condición Material</th>
					@break
					@case('stock')
					<th>Stock</th>
					@break
					@endswitch
					@endforeach
				</tr>

			</tfoot>
		</table>
		<br>
		{{-- {{$datos->render()}} --}}
	</div>
	<!-- /.card-body -->
</div>