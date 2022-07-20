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
        <table id="" class="table">
          <thead class="thead-dark">
            <tr>
              <th>Id</th>
              <th>Fecha</th>
              <th>Usuario</th>
              <th>Almacen Origen</th>
              <th>Almacen Destino</th>
              {{-- <th>Cantidad</th> --}}
              {{-- <th>Descripcion</th> --}}
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
                 {{--  <td>{{$soli->cantidad}}</td> --}}
                 {{--  <td>{{$soli->descripcion_material}}</td> --}}
                  <td>{{$soli->estatus_solicitud}}</td>
                  <td>{{$soli->observaciones}}</td>

                  <td>

                    {{-- @if(session('rol') == 0 || session('rol') == 1) --}}
                      {{-- <a href="{{route('verSolicitud',$soli->id_solicitud)}}">
                        <i class="fas fa-edit"></i>
                      </a> --}}

                    <button class="btn btn-success" onclick="window.location.href='{{route('verSolicitud',$soli->id_solicitud) }}'">
                      <i class="fas fa-edit"></i>
                    </button>

                      <button class="btn btn-danger" onclick="anula({{$soli->id_solicitud}})">
                        <i class="fas fa-ban"></i>
                      </button>

                      {{-- <a href="{{route('aprobarSolicitud',$soli->id_solicitud)}}">
                        <i class="fas fa-check"></i>
                      </a> --}}
                      {{-- <a href="#" id="anula">
                      <i class="fas fa-ban"></i>
                      </a> --}}
                     {{--  <a href="{{route('solicitudPdf',$soli->id_solicitud)}}">
                        <i class="fa fa-file-text" aria-hidden="true"></i>
                      </a> --}}
                   {{--  @endif

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
                    @endif --}}
                  </td>
                </tr>
              </tbody>
            @endforeach
          <tfoot class="thead-dark">
            <tr>
              <th>Id</th>
              <th>Fecha</th>
              <th>Usuario</th>
              <th>Almacen Origen</th>
              <th>Almacen Destino</th>
              {{-- <th>Cantidad</th> --}}
              {{-- <th>Descripcion</th> --}}
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

    <script type="text/javascript">
     function anula(id_solicitud){
      if (confirm('Desea Eliminar la Solicitud con ID '+id_solicitud+', esta accion es irreversible')){
        $.ajax({
          url: '/movimiento/anulacion/'+id_solicitud,
          method: 'post',
          data: {
            id_solicitud : id_solicitud,
            "_token" : "{{csrf_token()}}"
          },success(anulado){
            if (anulado == 1){
              alert('Solicitud anulada Exitosamente.')
            }else{
              alert('Fallo al realizar la anulacion.')
            }
          }
        })
      }
     }
    </script>
    @endsection