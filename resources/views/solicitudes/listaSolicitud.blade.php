@extends('layouts.dasboard')
  @section('title','Solicitudes')
    @section('mainPage')
    <div class="card">
      <div class="card-header">
        <div class="row">
          <div class="col-10">
            <h2>Listado de Solicitudes</h2>
          </div>
          <div class="col-2">
            <button type="button" class="btn btn-primary" onclick="window.location.href='{{Route('newSolicitud')}}'">
            <i class="nav-icon far fa-plus-square"> </i>
            <label style="margin-left: 5px; margin-right:2px;">Solicitud</label>
            </button>
          </div>
        </div>

      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>Id</th>
              <th>Descripcion</th>
              <th>Unidad de Medida</th>
              <th>Estado</th>
              <th>Municipio</th>
              <th>Parroquia</th>
              <th>Direccion</th>
              <th>Stock</th>
              <th>Aciones</th>
            </tr>
          </thead>
            @foreach($materiales as $material)
              <tbody>
                <tr>

                  <td>{{$material->id_material}}</td>
                  <td>{{$material->nombre_material}}</td>
                  <td>{{$material->nombre_almacen}}</td>
                  <td>{{$material->estado}}</td>
                  <td>{{$material->municipio}}</td>
                  <td>{{$material->parroquia}}</td>
                  <td>{{$material->direccion}}</td>
                  <td>{{$material->stock}}</td>
                  <td>
                    <a href="">
                      <i class="fas fa-file-import"></i>
                    </a>
                    {{-- <a href="">
                      <i class="fa-solid fa-trash"></i>
                    </a>
                    <a href="">
                      <i class="fa-solid fa-file-pdf"></i>
                    </a> --}}
                  </td>

                </tr>
              </tbody>
            @endforeach
          <tfoot>
            <tr>
              <th>Id</th>
              <th>Material</th>
              <th>Almacen</th>
              <th>Estado</th>
              <th>Municipio</th>
              <th>Parroquia</th>
              <th>Direccion</th>
              <th>Stock</th>
              <th>Aciones</th>
            </tr>
          </tfoot>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
    @endsection