@extends('layouts.dasboard')
@section('title','Registro de Vehiculo')
@section('mainPage')

<br>
	<div class="container">
		{{-- {{$estatusVehi}} --}}
		<div class="card-body bg-white">
			<div class="row">
				<div class="col-12">
					<div class="card card-danger">
			            <div class="card-header">
			            	<h3 class="card-title">Vehiculo</h3>
			            </div>
			            <!-- /.card-header -->
			           	<!-- form start -->
			            <form action="/guardarVehiculo" method="POST">
			            	
			            	<input type="hidden" value="" name="placaVehiculo">
			            	{{-- <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}"> --}}
			            	@csrf
			            	<div class="card-body row">
				                <div class="form-group col-2">
				                	<label for="exampleInputEmail1">Fecha</label>
				                    <input type="text" name="fecha" class="form-control" id="exampleInputEmail1" placeholder="" value="{{date('d/m/Y')}}">
				                </div>
			                  	<div class="form-group col-2">
			                    	<label for="exampleInputPassword1">Placa</label>
			                    	<input type="text" name="placa" class="form-control" id="exampleInputPassword1" placeholder="Placa">
			                  	</div>
				                <div class="col-sm-3">
				                    <!-- select -->
				                    <div class="form-group">
				                        <label>Marca</label>
				                        <select class="js-example-basic-single custom-select" name="marca" id="marca" onchange="llenarModelo()" required>
				                        	<option value="#" selected>Seleccione</option>
				                        	@foreach($marcas as $marca)
				                    	    	<option value="{{$marca->id_marca}}">{{$marca->marca}}</option>
				                    	    @endforeach
				                        </select>
				                     </div>
				                </div>

			                    <div class="col-sm-3">
			                      	<!-- select -->
			                      	<div class="form-group">
			                        	<label>Modelo</label>
			                        	<select class="js-example-basic-single custom-select" name="modelo" id="modelo" required>
			                          		<option value="null">Seleccione</option>
			                        	</select>
			                      	</div>
			                    </div>

			                    <div class="col-sm-2">
			                      	<!-- select -->
			                      	<div class="form-group">
			                        	<label>Año</label>
			                        	<select class="js-example-basic-single custom-select" name="anio">
			                          		<option value="1999">1999</option>
			                        	</select>
			                      	</div>
			                    </div>

			                    <div class="col-sm-4">
			                      	<!-- select -->
			                      	<div class="form-group">
			                          	<label>Color</label>
			                        	<select class="js-example-basic-single custom-select" name="color">
			                          		<option>Seleccione</option>
			                          		<option value="rojo" >Rojo</option>
			                        	</select>
			                      	</div>
			                    </div>

			                    <div class="col-sm-4">
			                      	<!-- select -->
			                      	<div class="form-group">
			                        	<label>Acueducto</label>
			                        		<select class="js-example-basic-single custom-select" name="acueducto">
			                        			<option value="" selected="true">Seleccione</option>
			                        			@foreach($acueductos as $acueducto)
			                          				<option value="{{$acueducto->id_acueducto}}">{{$acueducto->nom_acueducto}}</option>
			                          			@endforeach
			                        		</select>
			                      	</div>
			                    </div>

			                    <div class="col-sm-4">
			                      	<!-- select -->
			                      	<div class="form-group">
			                        	<label>Gerencia</label>
			                        		<select class="js-example-basic-single custom-select" name="gerencia">
			                        			<option value="" selected="true">Seleccione</option>
			                        			@foreach($gerencias as $gerencia)
			                          				<option value="{{$gerencia->id_gerencia}}">{{$gerencia->gerencia}}</option>
			                          			@endforeach
			                        		</select>
			                      	</div>
			                    </div>


				            	<div class="form-group col-4">
			                    	<label for="exampleInputPassword1">Serial de Carroceria</label>
			                    	<input type="text" name="serialCarroceria" class="form-control" id="exampleInputPassword1" placeholder="Serial de Carroceria" value="">
			                  	</div>




			                    <div class="form-group col-4">
			                        <label>Estatus Vehiculo</label>
			                        	<select class="js-example-basic-single custom-select" name="estatusVehiculo">
			                        		{{-- {{dd($)}} --}}
			                        		<option value="" selected="true">Seleccione</option>
			                        		@foreach($estatusVehi as $estatu)
			                        			<option value="{{$estatu->id_status_vehiculo}}">{{$estatu->status_vehiculo}}</option>
			                          		@endforeach
			                        	</select>
			                  	</div>
			                    

				                <div class="form-group col-4">
				                    	<label for="exampleInputPassword1">Kilometraje</label>
				                    	<input type="text" name="kilometraje" class="form-control" id="exampleInputPassword1" placeholder="Kilometraje" value="">
				                </div>
			                
			                </div><!-- /.card-body Cierre -->

			                   

			                <div class="card-footer">
				                <div class="row">
				                	<div class="col">
				                		<button type="submit" class="btn btn-primary">Guardar</button>
				                	</div>
				                  	<div class="col" align="right">
				                  		<a href="{{route('listaVehiculos')}}" class="btn btn-success col-3">Volver</a>
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

		function llenarModelo(){
			var marca = $('#marca').val()
			$.ajax({
				url : 'llenarModelo',
				type : 'post',
				data :	{
							id_marca : marca,
							"_token": "{{ csrf_token() }}"
						},
				success:function(modelo){
					var modelo = $.parseJSON(modelo)
					console.log(modelo)
					$('#modelo').empty()
					for (var i = 0; i < modelo.length; i++){
						$("#modelo").append("<option value='"+modelo[i].id_modelo+"'>"+modelo[i].modelo+"</option>")
					}
				}
			})
		}
	</script>
@endsection
