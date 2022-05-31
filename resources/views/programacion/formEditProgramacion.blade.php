@extends('layouts.dasboard')
@section('title','Nueva Programacion')
@section('mainPage')

<br>
	<div class="container">
		{{dd($edtProg)}}
		<div class="card-body bg-white">
			<div class="row">
				<div class="col-12">
					<div class="card card-danger">
			            <div class="card-header">
			            	<h3 class="card-title"> Editando Programación</h3>
			            </div>
			    <!-- /.card-header -->
			        <!-- form start -->
			            <form action="/guardarProgramacion" method="POST">
			            	<input type="text" value="" name="idProgramacion">
			            	<input type="text" value="" name="placaVehiculo">
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
				                        <select class="js-example-basic-single custom-select" name="marca" id="marca" onchange="llenarModelo()">
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
			                        	<select class="js-example-basic-single custom-select" name="modelo" id="modelo">
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

			                    <div class="col-sm-3">
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

			                    <div class="col-sm-3">
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




			                    <div class="form-group col-2">
			                        <label>Estatus Vehiculo</label>
			                        	<select class="js-example-basic-single custom-select" name="estatusVehiculo">
			                        		<option value="" selected="true">Seleccione</option>
			                        		@foreach($estatus as $estatu)
			                        			<option value="{{$estatu->id_status}}">{{$estatu->status}}</option>
			                          		@endforeach
			                        	</select>
			                  	</div>



			                    <div class="col-sm-3">
			                      	<!-- select -->
			                      	<div class="form-group">
			                          	<label>Color</label>
			                        	<select class="js-example-basic-single custom-select" name="color">
			                          		<option>Seleccione</option>
			                          		<option value="rojo" >Rojo</option>
			                        	</select>
			                      	</div>
			                    </div>

			                    <div class="form-group col-7">
				                    <label for="exampleInputPassword1">Taller</label>
				                    <input type="text" name="taller" class="form-control" id="" placeholder="" value="">
			                  	</div>

			                  	<div class="form-group col-2">
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
			                  	<a href="{{route('programacion')}}" class="btn btn-success col-3">Volver</a>
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
