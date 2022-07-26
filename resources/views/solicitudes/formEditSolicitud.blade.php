@extends('layouts.dasboard')
@section('title','Editando la Solicitud')
@section('mainPage')

<br>
	<div class="container">
		<div class="card-body bg-white">
			<div class="row">
				<div class="col-12">
					<div class="card card-danger">
			            <div class="card-header">
			            	<h3 class="card-title">Editar Solicitud</h3>
			            </div>
			            <!-- /.card-header -->
			           	<!-- form start -->
			            <form action="/editarSolicitud" method="POST">
			            	<input type="hidden" name="id_solicitud" value="{{$solicitud->id_solicitud}}">
			            	@csrf
			            	<div class="card-body row">
				                <div class="form-group col-2">
				                	<label for="exampleInputEmail1">Fecha</label>
				                    <input type="text" name="fecha" class="form-control" id="fecha" placeholder="" value="{{$solicitud->fecha_solicitud}}" readonly>
				                </div>

				                <div class="col-sm-3">
				                    <div class="form-group">
				                        <label>Almacen Origen</label>
				                    	<select class="js-example-basic-single custom-select" name="idAlmacenOrigen" id="almacenOrigen">
			                        		@foreach($almacenes as $almacen)
			                        			<option value="{{$almacen->id_almacen}}"@if($almacen->id_almacen == $solicitud->id_almacen_origen) selected="true"@endif>{{$almacen->nombre_almacen}}</option>
			                          		@endforeach
				                        </select>
				                     </div>
				                </div>

				                <div class="col-sm-4">
				                    <!-- select -->
				                    <div class="form-group">
				                        <label>Almacen Destino</label>
			                        	<select class="js-example-basic-single custom-select" name="idAlmacenDestino" id="almacenDestino">
				                        		@foreach($almacenOrigen as $almacen)
				                        			<option value="{{$almacen->id_almacen}}"@if($almacen->id_almacen == session('id_almacen')) selected="true")@endif>{{$almacen->nombre_almacen}}</option>
				                          		@endforeach
				                        </select>
				                     </div>
				                </div>

			                  	<div class="form-group col-3">
			                    	<label for="exampleInputPassword1">Tipo de Entrada</label>
			                    	<input class="form-control" type="text" name="statusSolicitud" id="statusSolicitud" value=""  placeholder="">
			                  	</div>

			                  	<div class="col-12">
				                  	<table class="table table-bordered" id="tablaMateriales">
				                  		<thead>
				                  			<tr>
				                  				<th>Codígo</th>
				                  				<th>Material</th>
				                  				<th>Cantidad Entrante</th>
				                  				<th>Acciones</th>
				                  			</tr>
				                  		</thead>
			                  			<tbody>
			                  				@foreach($materialesSolicitud as $materialSolicitud)
				                  				<tr class="clonarlo" id="fila-registro">
				                  					<td style="width:10em;">
	                                    				<input class="form-control idMaterial" type="text" id="idMaterial" name="idMaterial[]"  readonly value="{{$materialSolicitud->id_material}}">
				                  					</td>

				                  					<td>

				                  						<select class="js-example-basic-single custom-select material" name="material[]" id="material" onchange="traerStock($(this))">

	                                    					<option value="null">Seleccione</option>

	                                    					@foreach($materiales as $material)
	                                    						<option value="{{$material->id_material}}" @if($material->id_material == $materialSolicitud->id_material) selected="true" @endif>{{$material->descripcion_propuesta}}</option>
	                                    					@endforeach

	                                    				</select>

				                  					</td>

				                  					<td>
				                  						<input class="form-control cantidadSolicitada" type="text" id="cantidadSolicitada" name="cantidadSolicitada[]"  onkeypress="return valideKey(event)" value="{{$materialSolicitud->cantidad}}">
				                  					</td>

				                  					<td>
				                  						<button class="btn btn-primary" type="button" onclick="agregar_fila()"><i class="fas fa-plus"></i></button>
				                  						<button class="btn btn-danger" type="button" onclick="eliminar_fila($(this))">X</button>
				                  					</td>
				                  				</tr>
				                  			@endforeach
			                  			</tbody>
			                  			<tfoot>
				                  			<tr>
				                  				<th>Codígo</th>
				                  				<th>Material</th>
				                  				<th>Cantidad Entrante</th>
				                  				<th>Acciones</th>
				                  			</tr>
			                  			</tfoot>
 			                  		</table>
		                  		</div>

		                  		<div class="form-group col-12">
			                    	<label for="exampleInputPassword1">Observaciones</label>
			                    	<input class="form-control" type="text" name="observacionesSolicitud" id="observacionesSolicitud" value="{{$solicitud->observaciones}}">
			                  	</div>

		                  		<div class="col">
		                  			<button type="submit" class="btn btn-primary">Guardar</button>
		                  		</div>
		                  		<div class="col-3" align="right">
		                  			<a href="{{route('listaMovimientos')}}" class="btn btn-success col-4">Volver</a>
		                  		</div>

				            </div>
			                <!-- /.card-body -->

			                <!-- /.card-body -->
			            </form>
            		</div>{{-- CIERRE DEL DIV DE LA LINEA 11 --}}
				</div>{{-- CIERRE DEL DIV DE LA LINEA 10 --}}
			</div>{{-- CIERRE DEL DIV QUE ABRE EN LA LINEA 9 --}}
		</div>{{-- CIERRE DEL DIV QUE ABRE EN LA LINEA 8 --}}
	</div>{{-- CIERRE DEL DIV DE LA LINEA 6 --}}

	<script>
		function traerStock(obj) {

			var fila = obj.closest('tr');
			var material = fila.find(".material").val()

			//let material = $("#material").val()
			let almacen = $("#idMaterial").val()
			$.ajax({
				url : '/traerStock',
				method : 'post',
				data:{
					"_token" : "{{csrf_token()}}",
					id_material : material,
					id_almacen : almacen,
				},success:function(stock){
					console.log(stock)
					$("#stock").empty()
					var stockT = $.parseJSON(stock)

					fila.find('.idMaterial').val(stockT.id_material)
					fila.find('.stock').val(stockT.stock)
				}
			})
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

		function llenarAlmacenDestino(fila){

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

					// $("#almadesti").empty()
					$(".idMaterial").val('')
					$(".stock").val('')


					// for(var i = 0; i < almacenesRestantes.length; i++){
					// 	$("#almadesti").append("<option value='"+almacenesRestantes[i].id_almacen+"'>"+almacenesRestantes[i].nombre_almacen+"</option>")
					// }

					$("#material").empty()
					for(var i = 0; i < materiales.length; i++){
						$(".material").append("<option value='"+materiales[i].id_material+"'>"+materiales[i].nombre_material+"</option>")
					}
				}
			})
		}

		function validarStockExistencia(fila){

			var fila = fila.closest('tr');

			var cantidadSol = fila.find(".cantidadSolicitada").val()
			var stock = fila.find(".stock").val()

			if( stock < cantidadSol){
				alert('La cantidad Solicitada es MAYOR')
				$("#cantidadSolicitada").focus()
			}
		}


        function eliminar_fila(fila){

            var n_filas = fila.parent().closest('.table').find('.clonarlo').length
            var filaEliminar = fila.parent().closest('.clonarlo')

            if(n_filas > 1){
                filaEliminar.remove()
            }else{
                filaEliminar.find('input').val('')
                filaEliminar.find('select').empty()
            }
        }

		function agregar_fila(){

    		var id_tabla = 'tablaMateriales'
			var fila = $('#'+id_tabla+' .clonarlo').eq(0).clone(true,true)
			/*$('#'+id_tabla+' .clonarlo').empty()*/
			fila.find('input').val('')
			fila.find('select').val('0');
			$('#'+id_tabla).append(fila)
    	}


	</script>

@endsection
