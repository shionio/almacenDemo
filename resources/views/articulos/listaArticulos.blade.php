@extends('layouts.dasboard')
  @section('title','Articulos')
    @section('mainPage')
    <div class="card">
      <div class="card-header">
        <div class="row">
          <div class="col-10">
            <h2>Listado de Artículos</h2>
          </div>
{{-- {{dd($articulos)}} --}}
          {{-- <div class="col-2">
            <button type="button" class="btn btn-primary" onclick="window.location.href='{{Route('newArticulo')}}'">
            <i class="nav-icon far fa-plus-square"></i> Artículo</button>
          </div> --}}
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>Id</th>
              <th>Nombre</th>
              <th>Descripcion</th>
              <th>Stock</th>
              <th>Unidad de Medida</th>
              <th>Almacen</th>
              <th>Acciones</th>
            </tr>
          </thead>
            @foreach($articulos as $articulo)
              <tbody>
                <tr>
                  <td>{{$articulo->id_material}}</td>
                  <td>{{$articulo->nombre_material}}</td>
                  <td>{{$articulo->descripcion_material}}</td>
                  <td>{{$articulo->stock}}</td>
                  <td>{{$articulo->unidad_medida}}</td>
                  <td>{{$articulo->descripcion_almacen}}</td>

                  <td>
                    <a href="">
                      <i class="fas fa-sign-in-alt"></i>
                    </a>
                    <a href="">
                      <i class="fas fa-sign-out-alt" style="margin-left:5px;"></i>
                    </a>
                    <a href="">
                      <i class="fas fa-exchange" style="margin-left:5px;"></i>
                  </a>
                  </td>
                </tr>
              </tbody>
            @endforeach
          <tfoot>
            <tr>
               <th>Id</th>
              <th>Nombre</th>
              <th>Descripcion</th>
              <th>Stock</th>
              <th>Unidad de Medida</th>
              <th>Almacen</th>
              <th>Acciones</th>
            </tr>
          </tfoot>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
    @endsection