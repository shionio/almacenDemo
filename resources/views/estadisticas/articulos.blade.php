@extends('layouts.dasboard')
@section('title','Nueva Programacion')
@section('mainPage')

	{{-- {{dd($art)}} --}}

	<style type="text/css">
		table{
			width: 50%;
			align-self: center;
		}

		table td,th{
			text-align: center;
		}

	</style>

<div class="card">
      <div class="card-header">
        <div class="row">
          <div class="col-10">
            <h2>Existencias de Artículos</h2>
          </div>
          <div class="col-2">
          </div>
        </div>
      </div>

     <table>
     	<thead>
     		<tr>
	     		<th>ID</th>
	     		<th>Nombre</th>
	     		<th>Descripcion</th>
	     		<th>Existencias</th>
	     		<th>En Custodia</th>
	     		<th>Stock Inicial</th>
	     	</tr>
     	</thead>
     	<tbody>
     		@foreach($art as $arti)
     			<tr>
     				<td>{{$arti->id_material}}</td>
     				<td>{{$arti->nombre_material}}</td>
     				<td>{{$arti->descripcion_material}}</td>
     				<td>{{$arti->stock}}</td>
     				<td>0</td>
     				<td>{{$arti->stock_inicial}}</td>
     			</tr>
     		@endforeach
     	</tbody>
     	<tfoot>
     		<tr>
	     		<th>ID</th>
	     		<th>Nombre</th>
	     		<th>Descripcion</th>
	     		<th>Existencias</th>
	     		<th>En Custodia</th>
	     		<th>Stock Inicial</th>
	     	</tr>
     	</tfoot>
     </table>
	</div>
	{{-- {{dd($alm, $art)}} --}}
     <div class="card">
      <div class="card-header">
        <div class="row">
          <div class="col-10">
            <h3>Existencias en Almacen</h3>
          </div>
          <br><br>
        <form action="{{route('filtrar.art')}}" method="POST">
        	@csrf
        <div class="col-4">
          <select id="almacen" name="almacen">
          	@foreach($alm as $a)
          	<option value="{{$a->id_almacen}}">{{$a->nombre_almacen}}</option>
          	@endforeach
          </select>
      </div>
      <div>
          <select id="material" name="material">
          	@foreach($art as $m)
          	<option value="{{$m->id_material}}">{{$m->nombre_material}}</option>
          	@endforeach
          </select>
          <button type="submit">Enviar</button>
         </div>
      </form>
          <div class="col-2">
          </div>
        </div>
      </div>
	</div>



@endsection