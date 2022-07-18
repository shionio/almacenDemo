@extends('layouts.dasboard')
@section('title','Nuevo Articulo')
@section('mainPage')

<br>
	<div class="container">
		{{-- {{$estatusVehi}} --}}
		<div class="card-body bg-white">
			<div class="row">
				<div class="col-12">
					<div class="card card-danger">
			            <div class="card-header">
			            	<h3 class="card-title">Ingreso de Material</h3>
			            </div>

			            <!-- /.card-header -->
			           	<!-- form start -->
			            <form action="/guardarMaterial" method="POST" enctype="multipart/form-data">
			            	@csrf
			            	<div class="card-body row">
				                <div class="form-group col-2">
				                	<label for="exampleInputEmail1">Fecha</label>
				                    <input type="text" name="fecha" class="form-control" id="fecha" placeholder="" value="{{date('d/m/Y')}}" readonly>
				                </div>

				                <div class="col-sm-4">
				                    <!-- select -->
				                    <div class="form-group">
				                        <label>Materiales</label>
				                        {{-- <input class="form-control" type="text" name="nombreMaterial" id="nombreMaterial" value=""> --}}
				                        <select class="js-example-basic-single custom-select" name="idMaterial">
			                        	<option value="" selected="true">Seleccione</option>
			                        		@foreach($materiales as $material)
			                        			<option value="{{$material->id_material}}">{{$material->descripcion_propuesta}}</option>
			                          		@endforeach
			                        	</select>

				                     </div>
				                </div>

				                <div class="col-sm-2">
				                    <!-- select -->
				                    <div class="form-group">
				                        <label>Cantidad</label>
				                        <input class="form-control" type="text" name="stock" id="stock" value="" onkeypress="return valideKey(event)">
				                     </div>
				                </div>

				                <div class="form-group col-4">
			                    	<label for="exampleInputPassword1">Familia</label>
			                    	<select class="js-example-basic-single custom-select" name="idFamilia">
			                        	<option value="" selected="true">Seleccione</option>
			                        		@foreach($familias as $familia)
			                        			<option value="{{$familia->id_familia}}">{{$familia->nombre_familia}}</option>
			                          		@endforeach
			                        </select>
			                  	</div>

				                <div class="col-sm-3">
				                    <!-- select -->
				                    <div class="form-group">
				                        <label>Tipo de Ingreso</label>
				                        <select class="js-example-basic-single custom-select" name="tipoIngresos">
			                        		<option value="" selected="true">Seleccione</option>
			                        		@foreach($tipoMovimientos as $tipoMovimiento)
			                        			<option value="{{$tipoMovimiento->id_tipo_ingreso}}">{{$tipoMovimiento->tipo_ingreso}}</option>
			                          		@endforeach
			                        	</select>
				                     </div>
				                </div>
				                
			                  	{{-- <div class="form-group col-3">
			                    	<label for="exampleInputPassword1">Proveedor</label>
			                    	<select class="js-example-basic-single custom-select" name="proveedor">
			                        	<option value="" selected="true">Seleccione</option>
			                        		@foreach($proveedores as $proveedor)
			                        			<option value="{{$proveedor->id_proveedor}}">{{$proveedor->nombre_proveedor}}</option>
			                          		@endforeach
			                        </select>
			                  	</div>


			                    <div class="col-sm-3">
			                      	<div class="form-group">
			                        	<label>Nota de Entrega</label>
			                        	<input class="form-control" type="text" name="notaEntrega" id="notaEntrega" onkeypress="return valideKey(event)">
			                      	</div>
			                    </div>

			                    <div class="col-sm-3">
			                      	<div class="form-group">
			                        	<label>Orden de Compra</label>
			                        	<input class="form-control" type="text" name="ordenCompra" id="ordenCompra" onkeypress="return valideKey(event)">
			                      	</div>
			                    </div>

			                    <div class="col-sm-3">
			                      	<div class="form-group">
			                        	<label>N° Factura</label>
										<input class="form-control" type="text" id="nFactura" name="nFactura" onkeypress="return valideKey(event)">
			                      	</div>
			                    </div>

			                    <div class="col-sm-3">
			                      	<div class="form-group">
			                        	<label>N° Packlist</label>
			                        	<input class="form-control" type="text" id="packlist" name="packlist" onkeypress="return valideKey(event)">
			                      	</div>
			                    </div>

			                    <div class="form-group col-4">
			                    	<label for="exampleInputPassword1">Unidad de Medida</label>
			                    	<input type="text" name="unidadMedida" class="form-control" id="unidadMedida" placeholder="" value="">
			                  	</div>

				            	<div class="form-group col-5">
			                    	<label for="exampleInputPassword1">Direccion de Entrega</label>
			                    	<input type="text" name="direccionEntrega" class="form-control" id="direccionEntrega" placeholder="" value="">
			                  	</div>
 --}}
			                  	<div class="form-group col-3">
			                    	<label for="exampleInputPassword1">Almacen</label>
			                    	<select class="js-example-basic-single custom-select" name="idAlmacen">
			                        	<option value="" selected="true">Seleccione</option>
			                        		@foreach($almacenes as $almacen)
			                        			<option value="{{$almacen->id_almacen}}">{{$almacen->nombre_almacen}}</option>
			                          		@endforeach
			                        </select>
			                  	</div>

			                  	<div class="form-group col-3">
			                    	<label for="exampleInputPassword1">Estatus Material</label>
			                    	<select class="js-example-basic-single custom-select" name="estatusMaterial">
			                        	<option value="" selected="true">Seleccione</option>
			                        		@foreach($estatusMateriales as $statusMaterial)
			                        			<option value="{{$statusMaterial->id_estatus_material}}">{{$statusMaterial->desc_estatus_material}}</option>
			                          		@endforeach
			                        </select>
			                  	</div>

			                        		{{-- {{$condicionMateriales}} --}}
			                  	<div class="form-group col-3">
			                    	<label for="exampleInputPassword1">Condicion Material</label>
			                    	<select class="js-example-basic-single custom-select" name="condicionMaterial">
			                        	<option value="" selected="true">Seleccione</option>
			                        		@foreach($condicionMateriales as $condicionMaterial)
			                        			<option value="{{$condicionMaterial->id_condicion_material}}">{{$condicionMaterial->descrip_condicion_material}}</option>
			                          		@endforeach
			                        </select>
			                  	</div>

			                  {{-- 	<div class="form-group col-3">
			                    	<label for="exampleInputPassword1">Tipo de Ingreso</label>
			                    	<select class="js-example-basic-single custom-select" name="ingresoMaterial">
			                        	<option value="" selected="true">Seleccione</option>
			                        		@foreach($tipoIngreso as $ingreso)
			                        			<option value="{{$ingreso->id_tipo_ingreso}}">{{$ingreso->tipo_ingreso}}</option>
			                          		@endforeach
			                        </select>
			                  	</div> --}}

			                    <div class="form-group col-12">
			                        <label>Observaciones</label>
			                        <input type="text" name="observaciones" class="form-control" id="estatusVehiculo" value="">
			                  	</div>

			                  	<div class="col-6">
			                  		<label for="">Cargar Imagen Del Material</label>
			                  		<br>
									<input type="file" name="img_articulo" accept="image/png, .jpeg, .jpg" value="Cargar Imagen">
									{{-- <a href="" type="file" name="img_articulo2"> Cargar Imagen</a> --}}
			                  	</div>
				            </div>
			                <!-- /.card-body -->

			                <div class="card-footer">
			                  <div class="row">
			                  	<div class="col">
			                  	<button type="submit" class="btn btn-primary">Guardar</button>
			                  </div>
			                  <div class="col" align="right">
			                  	<a {{-- href="{{route('listaArticulos')}}" --}} class="btn btn-success col-3">Volver</a>
			                  </div>
			                  </div>
			                </div>
			            </form>
            		</div>
				</div>
			</div>
		</div>
	</div>
	<script>

		function valideKey(evt){
		    // code is the decimal ASCII representation of the pressed key.
		    var code = (evt.which) ? evt.which : evt.keyCode;

		    if(code==8) { // backspace.
		      return true;
		    } else if(code>=48 && code<=57) { // is a number.
		      return true;
		    } else{ // other keys.
		      return false;
		    }
		}


	</script>
@endsection
