@extends('layouts.dasboard')
@section('title','Nueva Programacion')
@section('mainPage')

<br>
	<div class="container">
		{{-- {{$estatusVehi}} --}}
		<div class="card-body bg-white">
			<div class="row">
				<div class="col-12">
					<div class="card card-danger">
			            <div class="card-header">
			            	<h3 class="card-title">Programación</h3>
{{-- {{$parametrosComunes}} --}}
			            	{{-- @if(Session::has('msg'))
								<div class="alert alert-success alert-dismissible" role="alert">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								  	{{Session::get('msg')}}
								</div>
							@endif --}}

			            </div>
			            	{{-- @if(isset($edtProgramacion))
			            		{{$edtProgramacion}}
			            	@endif --}}
			            <!-- /.card-header -->
			           	<!-- form start -->
			            <form action="/guardarProgramacion" method="POST">
			            	<input type="hidden" value="" name="idProgramacion">
			            	<input type="hidden" value="" name="placaVehiculo">
			            	{{-- <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}"> --}}
			            	@csrf
			            	<div class="card-body row">
				                <div class="form-group col-2">
				                	<label for="exampleInputEmail1">Fecha</label>
				                    <input type="text" name="fecha" class="form-control" id="fecha" placeholder="" value="{{date('d/m/Y')}}">
				                </div>
			                  	<div class="form-group col-2">
			                    	<label for="exampleInputPassword1">Placa</label>
			                    	<input type="text" name="placa" id="placa" class="form-control" id="exampleInputPassword1" placeholder="Placa" onblur="buscarVehiculo()">
			                  	</div>
				                <div class="col-sm-3">
				                    <!-- select -->
				                    <div class="form-group">
				                        <label>Marca</label>
				                        <input class="form-control" type="text" name="marca" id="marca" value="">
				                     </div>
				                </div>

			                    <div class="col-sm-3">
			                      	<!-- select -->
			                      	<div class="form-group">
			                        	<label>Modelo</label>
			                        	<input class="form-control" type="text" name="modelo" id="modelo">
			                      	</div>
			                    </div>

			                    <div class="col-sm-2">
			                      	<!-- select -->
			                      	<div class="form-group">
			                        	<label>Año</label>
			                        	<input class="form-control" type="text" name="anio" id="anio">
			                      	</div>
			                    </div>

			                    <div class="col-sm-3">
			                      	<!-- select -->
			                      	<div class="form-group">
			                        	<label>Acueducto</label>
										<input class="form-control" type="text" id="acueducto" name="acueducto">
			                      	</div>
			                    </div>

			                    <div class="col-sm-3">
			                      	<!-- select -->
			                      	<div class="form-group">
			                        	<label>Gerencia</label>
			                        	<input class="form-control" type="text" id="gerencia" name="gerencia">
			                      	</div>
			                    </div>


				            	<div class="form-group col-4">
			                    	<label for="exampleInputPassword1">Serial de Carroceria</label>
			                    	<input type="text" name="serialCarroceria" class="form-control" id="serialCarroceria" placeholder="" value="">
			                  	</div>




			                    <div class="form-group col-2">
			                        <label>Estatus Vehiculo</label>
			                        <input type="text" name="estatuVehiculo" class="form-control" id="estatusVehiculo" value="">
			                  	</div>



			                    <div class="col-sm-3">
			                      	<!-- select -->
			                      	<div class="form-group">
			                          	<label>Color</label>
			                        	<input type="text" name="color" class="form-control" id="color" value="">
			                      	</div>
			                    </div>

			                    <div class="form-group col-5">
				                    <label for="exampleInputPassword1">Taller</label>
				                    <input type="text" name="taller" class="form-control" id="" placeholder="" value="">
			                  	</div>

			                  	<div class="form-group col-4">
			                        <label>Estatus Programacion</label>
			                        	<select class="js-example-basic-single custom-select" name="estatusProgramacion">
			                        		<option value="" selected="true">Seleccione</option>
			                        		@foreach($estatus as $estatu)
			                        			<option value="{{$estatu->id_status}}">{{$estatu->status}}</option>
			                          		@endforeach
			                        	</select>
			                  	</div>

			                  	<div class="form-group col-12">
				                    <label for="exampleInputPassword1">Observaciones</label>
				                    <input type="textarea" name="observaciones" class="form-control" id="" placeholder="" value="">
			                  	</div>
				            </div>
			                <!-- /.card-body -->

			                <div class="card-footer">
			                  <div class="row">
			                  	<div class="col">
			                  	<button type="submit" class="btn btn-primary">Guardar</button>
			                  </div>
			                  <div class="col" align="right">
			                  	<a href="{{route('listaProgramacion')}}" class="btn btn-success col-3">Volver</a>
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

		function buscarVehiculo(){
			let placa = $("#placa").val()
			$.ajax({
				url: 'buscarVehiculo',
				method:'post',
				dataType: 'json',
				data:{
					"_token" : "{{csrf_token()}}",
					placa : placa
				},
				success : function(vehiculo){
					if(vehiculo == ''){
						alert('Placa N° '+placa+' No se encuentra registrada')
					}else{
						console.log(vehiculo)
						$("#marca").val(vehiculo[0].marca).attr('readonly',true)
						$("#modelo").val(vehiculo[0].modelo).attr('readonly',true)
						$("#anio").val(vehiculo[0].anio_vehiculo).attr('readonly',true)
						$("#acueducto").val(vehiculo[0].nom_acueducto).attr('readonly',true)
						$("#gerencia").val(vehiculo[0].gerencia).attr('readonly',true)
						$("#serialCarroceria").val(vehiculo[0].serial_carroceria).attr('readonly',true)
						$("#estatusVehiculo").val(vehiculo[0].status_vehiculo).attr('readonly',true)
						$("#color").val(vehiculo[0].color).attr('readonly',true)
					}
				}
			})
		}

		// function llenarModelo(){
		// 	var marca = $('#marca').val()
		// 	$.ajax({
		// 		url : 'llenarModelo',
		// 		type : 'post',
		// 		data :	{
		// 					id_marca : marca,
		// 					"_token": "{{ csrf_token() }}"
		// 				},
		// 		success:function(modelo){
		// 			var modelo = $.parseJSON(modelo)
		// 			console.log(modelo)
		// 			$('#modelo').empty()
		// 			for (var i = 0; i < modelo.length; i++){
		// 				$("#modelo").append("<option value='"+modelo[i].id_modelo+"'>"+modelo[i].modelo+"</option>")
		// 			}
		// 		}
		// 	})
		// }


	</script>
@endsection
