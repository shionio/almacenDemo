@extends('layouts.dasboard')
  @section('title','Solicitudes')
    @section('mainPage')
    <div class="card">
      <div class="card-header">
        <div class="row">
          <div class="col-10">
            <h2>Listado de Solicitudes</h2>
            {{-- {{dd($solicitudes);}} --}}
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
              <th>Fecha</th>
              <th>Usuario</th>
              <th>Almacen Origen</th>
              <th>Almacen Destino</th>
              <th>Cantidad</th>
              <th>Descripcion</th>
              <th>Unidad Medida</th>
              <th>Ubicacion</th>
              <th>Estatus</th>
              <th>Observaciones</th>
              <th>Acciones</th>
            </tr>
          </thead>
            @foreach($solicitudes as $soli)

            {{-- {{dd($soli)}} --}}
              <tbody>
                <tr>

                  <td>{{$soli->id_solicitud}}</td>
                  <td>{{$soli->fecha_solicitud}}</td>
                  <td>{{$soli->usuario}}</td>
                  <td>{{$soli->almaor}}</td>
                  <td>{{$soli->almades}}</td>
                  <td>{{$soli->cantidad}}</td>
                  <td>{{$soli->descripcion_material}}</td>
                  <td>{{$soli->unidad_medida}}</td>
                  <td>{{$soli->ubicacion}}</td>
                  <td>{{$soli->estatus}}</td>
                  <td>{{$soli->observaciones}}</td>

                  <td>
                    <a href="{{route('verSolicitud',$soli->id_solicitud)}}">
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
              <th>Fecha</th>
              <th>Usuario</th>
              <th>Almacen Origen</th>
              <th>Almacen Destino</th>
              <th>Cantidad</th>
              <th>Descripcion</th>
              <th>Unidad Medida</th>
              <th>Ubicacion</th>
              <th>Estatus</th>
              <th>Observaciones</th>
              <th>Acciones</th>
            </tr>
          </tfoot>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
    @endsection