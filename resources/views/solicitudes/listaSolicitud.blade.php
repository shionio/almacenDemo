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
             {{--  <th>Unidad Medida</th>
              <th>Ubicacion</th> --}}
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
                  <td>{{$soli->estatus_solicitud}}</td>
                  <td>{{$soli->observaciones}}</td>

                  <td>

                    @if(session('rol') == 1)
                      <a href="{{route('verSolicitud',$soli->id_solicitud)}}">
                        <i class="fas fa-edit"></i>
                      </a>
                      <a href="{{route('aprobarSolicitud',$soli->id_solicitud)}}">
                        <i class="fas fa-check"></i>
                      </a>
                      <a href="{{route('recibirSolicitud',$soli->id_solicitud)}}">
                        <i class="fas fa-arrow-alt-right"></i>
                      <i class="fas fa-sign-in"></i>
                      </a>
                      {{-- <a href="">
                        <i class="fas fa-sign-out"></i>
                      </a>
                      <a href="">
                        <i class="fas fa-undo"></i>
                      </a> --}}
                      <a href="{{route('solicitud.pdf',$soli->id_solicitud)}}">
                        <i class="fa fa-file-text" aria-hidden="true"></i>
                      </a>
                  @endif

                  @if(session('rol') == 2)
                     <a href="{{route('verSolicitud',$soli->id_solicitud)}}">
                      <i class="fas fa-edit"></i>
                    </a>
                  @endif

                  @if(session('rol') == 3)
                     <a href="{{route('verSolicitud',$soli->id_solicitud)}}">
                        <i class="fas fa-edit"></i>
                      </a>
                      <a href="{{route('aprobarSolicitud',$soli->id_solicitud)}}">
                        <i class="fas fa-check"></i>
                      </a>
                  @endif
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