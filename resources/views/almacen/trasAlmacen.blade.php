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
			            	<h3 class="card-title">Nueva Solicitud</h3>


			            </div>

			            <!-- /.card-header -->
			           	<!-- form start -->
			            <form action="/guardarArticulo" method="POST">
			            	@csrf
			            	<div class="card-body row">
				                <div class="form-group col-2">
				                	<label for="exampleInputEmail1">Fecha</label>
				                    <input type="text" name="fecha" class="form-control" id="fecha" placeholder="" value="{{date('d/m/Y')}}" readonly>
				                </div>

				                <div class="col-sm-3">
				                    <div class="form-group">
				                        <label>Almacen Origen</label>
				                    	<select class="js-example-basic-single custom-select" name="almacen1" id="almacen1" onchange="llenarAlmacenDestino()">
				                        </select>
				                     </div>
				                </div>

				                <div class="col-sm-4">
				                    <!-- select -->
				                    <div class="form-group">
				                        <label>Almacen Destino</label>
				                        <select class="js-example-basic-single custom-select" name="almacenDestino" id="almacendestino">
				                        	<option value="" selected="true">Seleccione</option>
				                        </select>
				                     </div>
				                </div>

				                {{-- <div class="form-group col-3">
			                    	<label for="exampleInputPassword1">Cantidad</label>
			                    	<input class="form-control" type="text" name="stock" id="stock" value="" onkeypress="return valideKey(event)">
			                  	</div> --}}

			                  	<div class="form-group col-3">
			                    	<label for="exampleInputPassword1">Estatus Solicitud</label>
			                    	<input class="form-control" type="text" name="stock" id="stock" value="">
			                  	</div>
				            </div>
			                <!-- /.card-body -->

			                <table class="table" align="center" id="tablaMateriales">
                                <tr>
                                    <th>Material</th>
                                    <th>Cantidad</th>
                                    <th>Stock</th>
                                    <th>Acciones</th>
                                </tr>
                                {{-- @foreach($materiales as $i => $material) --}}
                                    <tr class="clonarlo">
                                        <td>
                                            <input class="form-control" type="text" id="cantidad" name="cantidad[]" style="width:20em;" onkeypress="return valideKey(event)" value="{{-- {{$material->cantidad}} --}}">
                                        </td>
                                        <td><input class="form-control" type="text" id="material" name="material[]" style="width:25em;" value="{{-- {{ $material->material }} --}}"></td>
                                        <td><input class="form-control" type="text" id="ordenNum" name="ordenNum[]" style="width:8em;" onkeypress="return valideKey(event)" value="{{-- {{$material->orden_almacen}} --}}"></td>
                                        <td>
                                            <button class="btn btn-primary" type="button" onclick="agregar_fila()">
                                                <i class="fas fa-fw fa-plus-circle" style="align-center"></i>
                                            </button>

                                            <button class="btn btn-danger" type="button" onclick="eliminar_fila($(this))">
                                                <i class="fas fa-fw fa-times-circle"></i>
                                            </button>
                                        </td>
                                    </tr>
                                {{-- @endforeach --}}
                            </table>
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

		function buscarAlmacenes(){
			$.ajax({
				url:"/buscarAlmacen",
				method:"post",
				data:{
					'idAlmacen' : idAlmacen,
					"_token" : "{{ csrf_token() }}",
				},success:function(nalmacen){
					console.log(nalmacen)
					var almacen1 = $.parseJSON(nalmacen)
					$("#almacenOrigen")
					for(var i = 0; i < almacen1.length; i++){
						console.log(almacen1[i].nombre_almacen)
						$("#almacenOrigen").append("<option value='"+almacen1[i].id_almacen+"'>"+almacen1[i].nombre_almacen+"</option>")
					}
				}
			});
		}

		function llenarAlmacenDestino(){
			let idAlmacen = $("#almacenOrigen").val()
			//console.log(idAlmacen)

			$.ajax({
				url : "/llenarAlmaDesti",
				method: "post",
				data: {
					'idAlmacen' : idAlmacen,
					"_token" : "{{ csrf_token() }}",
				},success:function(almacen){
					//console.log(almacen)
					var almacen = $.parseJSON(almacen)
					$("#almacenDestino").empty()
					for(var i = 0; i < almacen.length; i++){
						console.log(almacen[i].nombre_almacen)
						 $("#almacenDestino").append("<option value='"+almacen[i].id_almacen+"'>"+almacen[i].nombre_almacen+"</option>")
					}
				}

			})
		}

	</script>
@endsection
