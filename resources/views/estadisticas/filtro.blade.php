@extends('layouts.dasboard')
@section('title','Nueva Programacion')
@section('mainPage')

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

@endsection