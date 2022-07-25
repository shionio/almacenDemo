@extends('layouts.dasboard')
@section('title','Nueva entrada de Material')
@section('mainPage')

{{-- {{dd($estatusMateriales, $almacenes, $condicionMateriales, $familias, $tipoMovimientos)}} --}}
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

							<div class="form-group col-4">
								<label for="exampleInputPassword1">Familia</label>
								<select class="js-example-basic-single custom-select" name="familia" id="familia" onchange="llenarMaterial()">
									<option value="null">FAMILIA</option>
									@foreach($familias as $familia)
									<option value="{{$familia->id_familia}}">{{$familia->nombre_familia}}</option>
									@endforeach
								</select>
							</div>
							<div class="col-sm-4">
								<!-- select -->
								<div class="form-group">
									<label>Materiales</label>
									{{-- <input class="form-control" type="text" name="nombreMaterial" id="nombreMaterial" value=""> --}}
									<select class="js-example-basic-single custom-select" name="idMaterial" id="idMaterial" required>
										<option value="null">Seleccione</option>
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
			                  		<select class="form-control" name="estatusMaterial" id="estatusMaterial">
			                  		<option class="form-control" name="estatusMaterial" id="estatusMaterial" value="{{$estatusMateriales->id_estatus_material}}" selected>{{$estatusMateriales->desc_estatus_material}}</option>
			                  	</select>
			                  	</div>

			                  	{{-- {{$condicionMateriales}} --}}
			                  	<div class="form-group col-3">
			                  		<label for="exampleInputPassword1">Condicion Material</label>
			                  		<select class="form-control" name="condicionMaterial" id="condicionMaterial">
			                  		<option class="form-control" value="{{$condicionMateriales->id_condicion_material}}">{{$condicionMateriales->descrip_condicion_material}}</option>
			                  	</select>
			                  	</div>

			                    <div class="form-group col-12">
			                    	<label>Observaciones</label>
			                    	<input type="text" name="observaciones" class="form-control" id="estatusVehiculo" value="">
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
	<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<script src="{{asset('select2/js/select2.min.js')}}"></script>
<script type="text/javascript">

  $(document).ready(function() {
    $('.js-example-basic-single').select2();
  });

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

		function llenarMaterial(){
			var familia = $('#familia').val()
      //console.log(estado)
      $.ajax({
      	url : '/solicitudes/material',
      	type : 'post',
      	data :  {
      		id_familia : familia,
      		"_token": "{{ csrf_token() }}"
      	},
      	success:function(materiales){
          // var materiales = $.parseJSON(materiales)
          $('#idMaterial').empty()
          $("#idMaterial").append("<option value='null'>Seleccione</option>")
          for (var i = 0; i < materiales.length; i++){
          	$("#idMaterial").append("<option value='"+materiales[i].id_material+"'>"+materiales[i].descripcion_propuesta+"</option>")
          }
      }
  })
  }

</script>
@endsection
