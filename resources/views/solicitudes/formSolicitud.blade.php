@extends('layouts.dasboard')
@section('title','Nueva Solicitud')
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
			            <form action="/guardarSolicitud" method="POST">
			            	@csrf
			            	<div class="card-body row">
				                <div class="form-group col-2">
				                	<label for="exampleInputEmail1">Fecha</label>
				                    <input type="text" name="fecha" class="form-control" id="fecha" placeholder="" value="{{date('d/m/Y')}}" readonly>
				                </div>

				                <div class="col-sm-3">
				                    <div class="form-group">
				                        <label>Almacen Origen</label>
				                    	<select class="js-example-basic-single custom-select" name="almacenOrigen" id="almacenOrigen" onchange="llenarAlmacenDestino()">
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

			                  	<div class="form-group col-4" >
			                  		<label for="exampleInputPassword1">Material</label>
			                  		<select class="js-example-basic-single custom-select" name="material" id="material" onchange="traerStock()">
                                    	<option value="null">Seleccione</option>
                                    </select>
			                  	</div>

			                  	<div class="form-group col-4">
			                  		<label for="exampleInputPassword1">Stock</label>
			                  		<input class="form-control" type="text" id="stock" name="stock" {{-- onkeypress="return valideKey(event)" --}} readonly>
			                  	</div>
			                  	<div class="form-group col-4">
			                  		<label for="exampleInputPassword1">Cantidad Solicitada</label>
			                  		<input class="form-control" type="text" id="cantidadSolicitada" name="cantidadSolicitada"  onkeypress="return valideKey(event)" onblur="validarStockExistencia()">
			                  	</div>

			                  	<div class="form-group col-12">
			                    	<label for="exampleInputPassword1">Observaciones</label>
			                    	<input class="form-control" type="text" name="observacionesSolicitud" id="observacionesSolicitud">
			                  	</div>


		                  		<div class="col">
		                  			<button type="submit" class="btn btn-primary">Guardar</button>
		                  		</div>
		                  		<div class="col-3" align="right">
		                  			<a href="{{route('listaMovimientos')}}" class="btn btn-success col-4">Volver</a>
		                  		</div>

				            </div>
			                <!-- /.card-body -->
				            </div>
			                <!-- /.card-body -->

                            <div class="card-footer">

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
