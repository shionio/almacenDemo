@extends('layouts.dasboard')
@section('title','Editar Solicitud')
@section('mainPage')

<br>
	<div class="container">
		<div class="card-body bg-white">
			<div class="row">
				<div class="col-12">
					<div class="card card-danger">
			            <div class="card-header">
			            	<h3 class="card-title">Editando Solicitud</h3>


			            </div>

			            <!-- /.card-header -->
			           	<!-- form start -->
			            <form action="/actualizarSolicitud" method="POST">
			            	@csrf
			            	<input type="hidden" value="{{$solicitud->id_solicitud}}" name="idSolicitud">
			            	<div class="card-body row">
				                <div class="form-group col-2">
				                	<label for="exampleInputEmail1">Fecha</label>
				                    <input type="text" name="fecha" class="form-control" id="fecha" placeholder="" value="{{$solicitud->fecha_solicitud}}" readonly>
				                </div>

				                <div class="col-sm-3">
				                    <div class="form-group">
				                        <label>Almacen Origen</label>

				                    	<select class="js-example-basic-single custom-select" name="almacenOrigen" id="almacenOrigen" onchange="llenarAlmacenDestino()">
				                        	<option value="" selected="true">Seleccione</option>
				                        		@foreach($almacenes as $almacen)
				                        			<option value="{{$almacen->id_almacen}}" @if($solicitud->id_almacen_origen === $almacen->id_almacen)selected='true' @endif >{{$almacen->nombre_almacen}}</option>
				                          		@endforeach
				                        </select>
				                     </div>
				                </div>

				                <div class="col-sm-4">
				                    <!-- select -->
				                    <div class="form-group">
				                        <label>Almacen Destino</label>
				                        <select class="js-example-basic-single custom-select" name="almacenDestino" id="almadesti" required >
				                        	<option value="#">Seleccione</option>
			                          		@foreach($almacenes as $almacen)
				                        			<option value="{{$almacen->id_almacen}}" @if($solicitud->id_almacen_destino == $almacen->id_almacen) selected="true"@endif>{{$almacen->nombre_almacen}}</option>
				                          		@endforeach
			                        	</select>

				                     </div>
				                </div>

			                  	<div class="form-group col-3">
			                    	<label for="exampleInputPassword1">Estatus Solicitud</label>
			                    	<select class="js-example-basic-single custom-select" name="estatusSolicitud" id="estatusSolicitud" required >
				                        	<option value="#">Seleccione</option>
			                          		@foreach($estatusSolicitudes as $estatusSolicitud)
				                       			<option value="{{$estatusSolicitud->id_estatus_solicitud}}" @if($solicitud->estatus === $estatusSolicitud->id_estatus_solicitud) selected="true"@endif>{{$estatusSolicitud->estatus_solicitud}}</option>
				                      		@endforeach
			                        </select>
			                  	</div>



			                  	<div class="form-group col-4" >
			                  		<label for="exampleInputPassword1">Material</label>
			                  		<select class="js-example-basic-single custom-select" name="material" id="material" onchange="traerStock()">
                                    	<option value="">Seleccione</option>
                                    	@foreach($materiales as $material)
	                          				<option value="{{$material->id_material}}" @if($material->id_material == $solicitud->id_material)selected="true"@endif >{{$material->nombre_material}}</option>
	                          			@endforeach
                                    </select>
			                  	</div>



			                  	<div class="form-group col-4">
			                  		<label for="exampleInputPassword1">Stock</label>
			                  		<input class="form-control" type="text" id="stock" name="stock" onkeypress="return valideKey(event)" value="{{$solicitud->stock}}" readonly>
			                  	</div>


			                  	<div class="form-group col-4">
			                  		<label for="exampleInputPassword1">Cantidad Solicitada</label>
			                  		<input class="form-control" type="text" id="cantidadSolicitada" name="cantidadSolicitada" value="{{$solicitud->cantidad}}"  onkeypress="return valideKey(event)" onblur="validarStockExistencia()">
			                  	</div>

			                  	<div class="form-group col-12">
			                    	<label for="exampleInputPassword1">Observaciones</label>
			                    	<input class="form-control" type="text" name="observacionesSolicitud" value="{{$solicitud->observaciones}}" id="observacionesSolicitud">
			                  	</div>
				            </div>
			                <!-- /.card-body -->
				            </div>
			                <!-- /.card-body -->

                            <div class="card-footer">
			                  <div class="row">
			                  	<div class="col">
			                  	<button type="submit" class="btn btn-primary">Guardar</button>
			                  </div>
			                  <div class="col" align="right">
			                  	<a href="{{route('listaMovimientos')}}" class="btn btn-success col-3">Volver</a>
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

		//
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
				},success:function(consultas){
					var consultas = $.parseJSON(consultas)
					let almacenesRestantes = consultas.almacenesRestantes
					let materiales = consultas.materialesAlmacen
					//console.log(materiales)
					$("#almadesti").empty()
					for(var i = 0; i < almacenesRestantes.length; i++){
						$("#almadesti").append("<option value='"+almacenesRestantes[i].id_almacen+"'>"+almacenesRestantes[i].nombre_almacen+"</option>")
					}

					$("#material").empty()
					for(var i = 0; i < materiales.length; i++){
						$("#material").append("<option value='"+materiales[i].id_material+"'>"+materiales[i].nombre_material+"</option>")
					}


				}

			})
		}

		function validarStockExistencia(){
			var cantidadSol = $("#cantidadSolicitada").val()
			var stock = $("#stock").val()

			if(cantidadSol > stock){
				alert('La cantidad Solicitada es MAYOR')
				$("#cantidadSolicitada").focus()
			}
		}


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


//function actualizarStock(){
		// 	// alert('a')
		// 	var cantidadSol = $("#cantidadSolicitada").val()
		// 	var stock = $("#stock").val()
		// 	console.log(cantidadSol)

		// 	if(cantidadSol < stock ){
		// 		var total = (stock - cantidadSol)
		// 		console.log(total)
		// 		//$("#stockRestante").val(total)
		// 	}else{
		// 		alert('Cant, solicitada mayor al Stock en almacen')
		// 	}

		// }


		// function agregar_fila(){
  //   		var id_tabla = 'tablaMateriales';
		// 	var fila = $('#'+id_tabla+' .clonarlo').eq(0).clone(true,true)
		// 	fila.find('input').val('')
		// 	fila.find('select').val('0');
		// 	$('#'+id_tabla).appendto(fila)
  //   	}


	</script>
@endsection
