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
          <div class="col-2">
            <button type="button" class="btn btn-primary" onclick="window.location.href='{{Route('newArticulo')}}'">
            <i class="nav-icon far fa-plus-square"></i> Artículo</button>
          </div>
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
              <th>Unidad de Medida</th>
              <th>Acciones</th>
            </tr>
          </thead>
            @foreach($articulos as $articulo)
              <tbody>
                <tr>
                  <td>{{$articulo->id_material}}</td>
                  <td>{{$articulo->nombre_material}}</td>
                  <td>{{$articulo->descripcion_material}}</td>
                  <td>{{$articulo->unidad_medida}}</td>
                  <td></td>
{{--
                  <td>
                    <a href="{{Route('editando',$programacion->id_programacion)}}">
                       <i class="fa-solid fa-pen-to-square"></i> --}}
                    {{-- </a> --}}
                    {{-- <a href=""> --}}
                      {{-- <i class="fa-solid fa-trash"></i> --}}
                  {{-- </a> --}}
                    {{-- <a href=""> --}}
                      {{-- <i class="fa-solid fa-file-pdf"></i> --}}
                  {{-- </a> --}}
                  {{-- </td> --}}
                </tr>
              </tbody>
            @endforeach
          <tfoot>
            <tr>
              <th>Id</th>
              <th>Nombre</th>
              <th>Descripcion</th>
              <th>Unidad de Medida</th>
              <th>Acciones</th>
            </tr>
          </tfoot>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
    @endsection