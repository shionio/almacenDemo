@extends('layouts.dasboard')
@section('title','Busqueda Avanzada')
@section('mainPage')

{{-- {{dd($alm, $est, $con, $mat, $fam)}} --}}
<div class="card">
	<div class="card-body">
		{{ Form::open(['route' => 'generar.reporte', 'method' => 'GET']),(['role' => 'form']) }}
		@csrf
		<div class="row">
			<div class="col-sm-4">
				<label>ALMACENES</label>
				<select class="js-example-basic-single custom-select" name="almacen">
					<option value="">Seleccionar Almacen</option>
					@foreach($alm as $almacenes)
					<option value="{{$almacenes->id_almacen}}">{{$almacenes->siglas_almacen}} - {{$almacenes->nombre_almacen}}</option>
					@endforeach
				</select>
			</div>
			<div class="col-sm-4">
				<label>MATERIAL</label>
				<select class="js-example-basic-single custom-select" name="material">
					<option value="">Seleccionar Material</option>
					@foreach($mat as $material)
					<option value="{{$material->id_material}}">{{$material->codigo}} - {{$material->descripcion_propuesta}}</option>
					@endforeach
				</select>
			</div>
			<div class="col-sm-4">
				<label>ESTATUS MATERIAL</label>
				<select class="js-example-basic-single custom-select" name="estatus">
					<option value="">Seleccionar Estatus</option>
					@foreach($est as $estatus)
					<option value="{{$estatus->id_estatus_material}}">{{$estatus->desc_estatus_material}}</option>
					@endforeach
				</select>
			</div>
			<div class="col-sm-4">
				<label>CONDICION MATERIAL</label>
				<select class="js-example-basic-single custom-select" name="condicion">
					<option value="">Seleccionar Condicion</option>
					@foreach($con as $condicion)
					<option value="{{$condicion->id_condicion_material}}">{{$condicion->descrip_condicion_material}}</option>
					@endforeach
				</select>
			</div>
			<div class="col-sm-4">
				<label>FAMILIA</label>
				<select class="js-example-basic-single custom-select" name="familia">
					<option value="">Seleccionar Familia</option>
					@foreach($fam as $familia)
					<option value="{{$familia->id_familia}}">{{$familia->nombre_familia}}</option>
					@endforeach
				</select>
			</div>
			<div class="col-sm-2">
				<br>
				<label>Activo</label>
				<input type="radio" name="estado" value="true" checked>
			</div>
			<div class="col-sm-2">
				<br>
				<label>Inactivo</label>
				<input type="radio" name="estado" id="estado" value="false">
			</div>
			<div class="col-sm-12" align="center">
				<br>
				<button type="submit" name="buscar" id="buscar" class="btn btn-primary" value="1">BUSCAR</button>
			</div>
			{{-- <div class="col-sm-6" align="center">
				<br>
				<button type="submit" name="buscar" id="buscar" class="btn btn-success" value="2">DESCARGAR PDF</button>
			</div> --}}
		</div>
		{{ Form::close() }}
	</div>
</div>
<div class="card">
	<div class="card-body">
		@if($errors->any())
		<h4>{{$errors->first()}}</h4>
		@endif
	</div>
</div>
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<script src="{{asset('select2/js/select2.min.js')}}"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('.js-example-basic-single').select2();
	});
</script>

@endsection