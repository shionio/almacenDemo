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
              @if(session('rol')==1)
                <th>Acciones</th>
              @endif
            </tr>
          </thead>
            @foreach($articulos as $articulo)
              @if($articulo->stock < 10)
                <tbody>
                  <tr style="background-color: orange ;">
                    <td>{{$articulo->id_material}}</td>
                    <td>{{$articulo->nombre_material}}</td>
                    <td>{{$articulo->descripcion_material}}</td>
                    <td>{{$articulo->stock}}</td>
                    <td>{{$articulo->unidad_medida}}</td>
                    <td>{{$articulo->descripcion_almacen}}</td>
                    @if(session('rol')==1)
                      <td>
                        <a href="">
                          <i class="fas fa-edit" style="margin-right: 5px;"></i>
                        </a>
                        <a href="">
                          <i class="fas fa-eye" style="margin-right: 5px;"></i>
                        </a>

                        <a href="">
                          <i class="fas fa-plus-circle" style="margin-right: 5px;"></i>
                        </a>
                    @endif
                  </tr>
              @else
                <tr>
                    <td>{{$articulo->id_material}}</td>
                    <td>{{$articulo->nombre_material}}</td>
                    <td>{{$articulo->descripcion_material}}</td>
                    <td>{{$articulo->stock}}</td>
                    <td>{{$articulo->unidad_medida}}</td>
                    <td>{{$articulo->descripcion_almacen}}</td>
                    @if(session('rol')==1)
                      <td>
                        <a href="" onclick="hola()">
                          <i class="fas fa-edit" style="margin-right: 5px;"></i>
                        </a>
                        <a href="">
                          <i class="fas fa-eye" style="margin-right: 5px;"></i>
                        </a>

                        <a href="">
                          <i class="fas fa-plus-circle" style="margin-right: 5px;"></i>
                        </a>
                      </td>
                    @endif
                  </tr>
                </tbody>
              @endif
            @endforeach
          <tfoot>
            <tr>
               <th>Id</th>
              <th>Nombre</th>
              <th>Descripcion</th>
              <th>Stock</th>
              <th>Unidad de Medida</th>
              <th>Almacen</th>
              @if(session('rol')==1)
              <th>Acciones</th>
              @endif
            </tr>
          </tfoot>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
    <script type="text/javascript">
      function hola(){
        alert('xD')
      }
    </script>
    @endsection