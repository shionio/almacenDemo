@extends('layouts.dasboard')
@section('title','Editar Material')
@section('mainPage')

<br>
{{-- {{dd($art)}} --}}
<div class="container">
	<div class="card-body bg-white">
		<div class="row">
			<div class="col-12">
				<div class="card card-danger">
					<div class="card-header">
						<h3 class="card-title">Ingreso de Material</h3>
					</div>
				</div>
				<form action="{{Route('guardarArt',$art->id_material)}}" method="POST" enctype="multipart/form-data">
					@csrf
					<div class="card-body row">
						<div class="form-group col-2">
							<label for="exampleInputEmail1">Código</label>
							<input type="text" name="codigo" class="form-control" id="codigo" value="{{$art->codigo}}" maxlength="10">
						</div>

						<div class="col-sm-4">
							<!-- select -->
							<div class="form-group">
								<label>Descripcion</label>
								<input class="form-control" type="text" name="nombreMaterial" id="nombreMaterial" value="{{$art->descripcion_propuesta}}">
							</div>
						</div>
						<div class="col-sm-2">
							<!-- select -->
							<div class="form-group">
								<label>Unidad Medida</label>
								<input class="form-control" type="text" name="medida" id="medida" value="{{$art->unidad_medida}}">
							</div>
						</div>

						<div class="form-group col-4">
							<label for="exampleInputPassword1">Familia</label>
							<select class="js-example-basic-single custom-select" name="familia">
								<option value="{{$art->id_familia}}" selected="true">{{$art->nombre_familia}}</option>
								@foreach($fam as $familia)
								<option value="{{$familia->id_familia}}">{{$familia->nombre_familia}}</option>
								@endforeach
							</select>
						</div>
						<div class="col-sm-4">
						<input class="btn btn-success" type="submit" name="guardar" value="Guardar">
					</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>



<script>

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
