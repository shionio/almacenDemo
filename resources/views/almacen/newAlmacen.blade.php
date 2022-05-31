@extends('layouts.dasboard')
@section('title','Registro de Almacen')
@section('mainPage')

<br>
	<div class="container">
		{{-- {{$tipoAlmacenes}}
		{{$condicionAlmacenes}} --}}
		<div class="card-body bg-white">
			<div class="row">
				<div class="col-12">
					<div class="card card-danger">
			            <div class="card-header">
			            	<h3 class="card-title">Nuevo Almacen</h3>
			            </div>
			            <!-- /.card-header -->
			           	<!-- form start -->
			            <form action="/guardarAlmacen" method="POST">
		            {{-- {{session('id_usuario')}} --}}
			            	@csrf
			            	<div class="card-body row">
				                <div class="form-group col-2">
				                	<label for="exampleInputEmail1">Fecha</label>
				                    <input type="text" name="fecha" class="form-control" id="exampleInputEmail1" placeholder="" value="{{date('d/m/Y')}}" readonly>
				                </div>

			                  	<div class="form-group col-2">
			                    	<label for="exampleInputPassword1">Nombre</label>
			                    	<input type="text" name="nombreAlmacen" class="form-control" id="exampleInputPassword1">
			                  	</div>

				                <div class="col-sm-2">
				                    <!-- select -->
				                    <div class="form-group">
				                        <label>Estado</label>
				                        <select class="js-example-basic-single custom-select" name="estado" id="estado" onchange="llenarMunicipios()" required>
				                        	<option value="#" selected>Seleccione</option>
				                        	@foreach($estados as $estado)
				                    	    	<option value="{{$estado->id_estado}}">{{$estado->estado}}</option>
				                    	    @endforeach
				                        </select>
				                     </div>
				                </div>

			                    <div class="col-sm-3">
			                      	<!-- select -->
			                      	<div class="form-group">
			                        	<label>Municipio</label>
			                        	<select class="js-example-basic-single custom-select" name="municipio" id="municipio" onchange="llenarParroquias()" required>
			                          		<option value="null">Seleccione</option>
			                        	</select>
			                      	</div>
			                    </div>

			                    <div class="col-sm-3">
			                      	<!-- select -->
			                      	<div class="form-group">
			                        	<label>Parroquia</label>
			                        	<select class="js-example-basic-single custom-select" name="parroquia" id="parroquia" required>
			                          		<option value="null">Seleccione</option>
			                        	</select>
			                      	</div>
			                    </div>

			                    <div class="col-sm-3">
			                      	<!-- select -->
			                      	<div class="form-group">
			                          	<label>Direccion</label>
			                        	<input type="text" name="direccionAlmacen" class="form-control" id="exampleInputPassword1" required>
			                      	</div>
			                    </div>

			                     <div class="col-sm-3">
			                      	<!-- select -->
			                      	<div class="form-group">
			                          	<label>Codigo Postal</label>
			                        	<input type="text" name="codigoPostal" id="codPostal" class="form-control" onkeypress="return valideKey(event)" required>
			                      	</div>
			                    </div>

			                    <div class="col-sm-3">
			                      	<!-- select -->
			                      	<div class="form-group">
			                        	<label>Tipo Almacen</label>
			                        		<select class="js-example-basic-single custom-select" name="tipoAlmacen" required>
			                        			<option value="" selected="true">Seleccione</option>
			                        			@foreach($tipoAlmacenes as $tipoAlmacen)
			                          				<option value="{{$tipoAlmacen->id}}">{{$tipoAlmacen->tipo_almacen}}</option>
			                          			@endforeach
			                        		</select>
			                      	</div>
			                    </div>

			                    <div class="col-sm-3">
			                      	<!-- select -->
			                      	<div class="form-group">
			                        	<label>Condicion Almacen</label>
			                        		<select class="js-example-basic-single custom-select" name="condicionAlmacen" required>
			                        			<option value="" selected="true">Seleccione</option>
			                        			@foreach($condicionAlmacenes as $condicionAlmacen)
			                          				<option value="{{$condicionAlmacen->id}}">{{$condicionAlmacen->condicion_almacen}}</option>
			                          			@endforeach
			                        		</select>
			                      	</div>
			                    </div>

			                     <div class="col-sm">
			                      	<!-- select -->
			                      	<div class="form-group">
			                          	<label>Descripcion Almacen</label>
			                        	<input type="text" name="descripcionAlmacen" id="" class="form-control" required {{-- onkeypress="return valideKey(event)" --}}>
			                      	</div>
			                    </div>

			                
			                </div><!-- /.card-body Cierre -->

			                   

			                <div class="card-footer">
				                <div class="row">
				                	<div class="col">
				                		<button type="submit" class="btn btn-primary">Guardar</button>
				                	</div>
				                  	<div class="col" align="right">
				                  		<a href="{{route('listaAlmacenes')}}" class="btn btn-success col-3">Volver</a>
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



		function llenarMunicipios(){
			var estado = $('#estado').val()
			//console.log(estado)
			$.ajax({
				url : '/llenarMunicipios',
				type : 'post',
				data :	{
							id_estado : estado,
							"_token": "{{ csrf_token() }}"
						},
				success:function(municipios){
					var municipios = $.parseJSON(municipios)
					$('#municipio').empty()
					for (var i = 0; i < municipios.length; i++){
						$("#municipio").append("<option value='"+municipios[i].id_municipio+"'>"+municipios[i].municipio+"</option>")
					}
				}
			})
		}

		function llenarParroquias(){
			let id_muni = $('#municipio').val()
			let estado = $('#estado').val()

			$.ajax({
				url : '/llenarParroquias',
				type : 'post',
				data : {
					id_municipio : id_muni,
					id_estado : estado,
					"_token": "{{ csrf_token() }}"
				},success:function(parroquias){
					console.log(parroquias)
					var parroquias = $.parseJSON(parroquias)
					$('#parroquia').empty()
					for (var i = 0; i < parroquias.length; i++){
						$("#parroquia").append("<option value='"+parroquias[i].id_parroquia+"'>"+parroquias[i].parroquia+"</option>")
					}
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
	</script>
@endsection
