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
				                    	<select class="js-example-basic-single custom-select" name="almacen" id="almacenOrigen" onchange="llenarAlmacenDestino()">
				                        	<option value="" selected="true">Seleccione</option>
				                        		@foreach($almacenes as $almacen)
				                        			<option value="{{$almacen->id_almacen}}">{{$almacen->nombre_almacen}}</option>
				                          		@endforeach
				                        </select>
				                     </div>
				                </div>

				                <div class="col-sm-4">
				                    <!-- select -->
				                    <div class="form-group">
				                        <label>Almacen Destino</label>
				                        <select class="js-example-basic-single custom-select" name="almacenDestino" id="almadesti" required >
			                          		<option value="null">Seleccione</option>
			                        	</select>

				                     </div>
				                </div>

			                  	<div class="form-group col-3">
			                    	<label for="exampleInputPassword1">Estatus Solicitud</label>
			                    	<input class="form-control" type="text" name="statusSolicitud" id="statusSolicitud" value="Nueva Solicitud" readonly="true">
			                  	</div>

			                  	<div class="form-group col-3" >
			                  		<label for="exampleInputPassword1">Material</label>
			                  		<select class="js-example-basic-single custom-select" name="material[]" id="material" onchange="traerStock()">
                                            	<option value="">Seleccione</option>
                                            	@foreach($materiales as $material)
			                          				<option value="{{$material->id_material}}">{{$material->nombre_material}}</option>
			                          			@endforeach
                                            </select>
			                  	</div>

			                  	<div class="form-group col-3">
			                  		<label for="exampleInputPassword1">Stock</label>
			                  		<input class="form-control" type="text" id="stock" name="stock" onkeypress="return valideKey(event)">
			                  	</div>
			                  	<div class="form-group col-3">
			                  		<label for="exampleInputPassword1">Cantidad Solicitada</label>
			                  		<input class="form-control" type="text" id="cantidadSolicitada" name="cantidadSolicitada"  onkeydown="actualizarStock()">
			                  	</div>
			                  	<div class="form-group col-3">
			                  		<label for="exampleInputPassword1">Restante</label>
			                  		<input class="form-control" type="text" id="stockRestante" name="stockRestante">
			                  	</div>

			                  	<div class="form-group col-12">
			                    	<label for="exampleInputPassword1">Observaciones</label>
			                    	<input class="form-control" type="text" name="observacionesSolicitud" id="observacionesSolicitud">
			                  	</div>
				            </div>
			                <!-- /.card-body -->



				            </div>
			                <!-- /.card-body -->

			               {{--  <table class="table" align="center" id="tablaMateriales">
                                <tr>
                                    <th>Material</th>
                                    <th>Cantidad</th>
                                    <th>Stock</th>
                                    <th>Acciones</th>
                                </tr>
                                @foreach($materiales as $i => $material)
                                    <tr class="clonarlo">
                                        <td>
                                            <input class="form-control" type="text" id="cantidad" name="cantidad[]" style="width:20em;" onkeypress="return valideKey(event)" value=" {{$material->cantidad}}">
                                        </td>
                                        <td><input class="form-control" type="text" id="material" name="material[]" style="width:25em;" value=" {{ $material->material }} ">
                                        </td>
                                        <td><input class="form-control" type="text" id="ordenNum" name="ordenNum[]" style="width:8em;" onkeypress="return valideKey(event)" value=" {{$material->orden_almacen}}"></td>
                                        <td>
                                            <button class="btn btn-primary" type="button" onclick="agregar_fila()">
                                                <i class="fas fa-fw fa-plus-circle" style="align-center"></i>
                                            </button>

                                            <button class="btn btn-danger" type="button" onclick="eliminar_fila($(this))">
                                                <i class="fas fa-fw fa-times-circle"></i>
                                            </button>
                                        </td>
                                    </tr>
                                 @endforeach --}}
                            {{-- </table> --}}
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

		function traerStock() {
			let material = $("#material").val()
			$.ajax({
				url : '/traerStock',
				method : 'post',
				data:{
					"_token" : "{{csrf_token()}}",
					id_material : material
				},success:function(stock){
					$("#stock").empty()
					var stockT = $.parseJSON(stock)
					//console.log(stockT.stock)
					$("#stock").val(stockT.stock).attr('readonly',true)
				}
			})
		}

		function actualizarStock(){
			// alert('a')
			var cantidadSol = $("#cantidadSolicitada").val()
			var stock = $("#stock").val()
			console.log(cantidadSol)

			/*if(cantidadSol < stock ){
				var total = (stock - cantidadSol)
				console.log(total)
				//$("#stockRestante").val(total)
			}else{
				alert('Cant, solicitada mayor al Stock en almacen')
			}*/

		}

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

		function llenarAlmacenDestino(){
			let idAlmacen = $("#almacenOrigen").val()
			$.ajax({
				url : "/llenarAlmaDesti",
				method: "post",
				data: {
					'idAlmacen' : idAlmacen,
					"_token" : "{{ csrf_token() }}",
				},success:function(almacen){
					var almacen = $.parseJSON(almacen)
					$("#almadesti").empty()
					for(var i = 0; i < almacen.length; i++){
						console.log(almacen[i].nombre_almacen)
						$("#almadesti").append("<option value='"+almacen[i].id_almacen+"'>"+almacen[i].nombre_almacen+"</option>")
					}
				}
			})
		}


		// function agregar_fila(){
  //   		var id_tabla = 'tablaMateriales';
		// 	var fila = $('#'+id_tabla+' .clonarlo').eq(0).clone(true,true)
		// 	fila.find('input').val('')
		// 	fila.find('select').val('0');
		// 	$('#'+id_tabla).appendto(fila)
  //   	}

        function eliminar_fila(fila){

            var n_filas = fila.parent().closest('.table').find('.clonarlo').length
            var filaEliminar = fila.parent().closest('.clonarlo')
            //console.log(filaEliminar)

            if(n_filas > 1){
                filaEliminar.remove()
            }else{
                filaEliminar.find('input').val('')
            }


        }


	</script>
@endsection
