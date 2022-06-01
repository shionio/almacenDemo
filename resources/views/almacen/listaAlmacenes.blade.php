@extends('layouts.dasboard')
  @section('title','Almacenes')
    @section('mainPage')
    <div class="card">
      <div class="card-header">
        <div class="row">
          <div class="col-10">
            <h2>Listado de Almacenes</h2>
          </div>
          <div class="col-2">
            {{-- <button type="button" class="btn btn-primary" onclick="window.location.href='{{Route('newAlmacen')}}'">
            <i class="nav-icon far fa-plus-square"> </i>
            <label style="margin-left: 5px; margin-right:2px;">Almacen</label>
            </button> --}}
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
              <th>Estado</th>
              <th>Municipio</th>
              <th>Parroquia</th>
              <th>Direccion</th>
              <th>Activo</th>
              <th>Aciones</th>
            </tr>
          </thead>
            @foreach($almacenes as $almacen)
              <tbody>
                <tr>
                  <td>{{$almacen->id_almacen}}</td>
                  <td>{{$almacen->nombre_almacen}}</td>
                  <td>{{$almacen->descripcion_almacen}}</td>
                  <td>{{$almacen->estado}}</td>
                  <td>{{$almacen->municipio}}</td>
                  <td>{{$almacen->parroquia}}</td>
                  <td>{{$almacen->direccion}}</td>
                  @if($almacen->activo == true)
                    <td>Activo</td>
                  @else
                    <td>Inactivo</td>
                  @endif
                  <td>
                    <a href="{{Route('traspaso')}}">
                      <i class="fa-solid fa-pen-to-square"></i>
                    </a>
                    <a href="">
                      <i class="fa-solid fa-trash"></i>
                    </a>
                    <a href="">
                      <i class="fa-solid fa-file-pdf"></i>
                    </a>
                  </td>
                  <td></td>
                </tr>
              </tbody>
            @endforeach
          <tfoot>
            <tr>
              <th>Id</th>
              <th>Nombre</th>
              <th>Descripcion</th>
              <th>Estado</th>
              <th>Municipio</th>
              <th>Parroquia</th>
              <th>Direccion</th>
              <th>Activo</th>
              <th>Aciones</th>
            </tr>
          </tfoot>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
    @endsection