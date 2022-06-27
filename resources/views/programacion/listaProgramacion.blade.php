@extends('layouts.dasboard')
  @section('title','Programacion')
    @section('mainPage')
    <div class="card">
      <div class="card-header">
        <div class="row">
          <div class="col-10">
            <h3 class="card-title">Listado de Programación</h3>
          </div>
{{-- {{dd($programaciones)}} --}}
          <div class="col-2">
            <button type="button" class="btn btn-primary" onclick="window.location.href='{{Route('newProgramacion')}}'">
            <i class="nav-icon far fa-plus-square"> </i>
            Programación
            </button>
          </div>
        </div>
         {{-- <div class="col-4">
            @if(Session::has('msg'))
              <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
                  {{Session::get('msg')}}
              </div>
            @endif
         </div> --}}

      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>Fecha</th>
              <th>Marca</th>
              <th>Modelo</th>
              <th>Placa</th>
              <th>Serial Carroc</th>
              <th>Año</th>
              <th>Color</th>
              <th>Taller</th>
              <th>Acued</th>
              <th>Estatus</th>
              <th>Obs</th>
              <th>Aciones</th>
            </tr>
          </thead>
            @foreach($programaciones as $programacion)
              <tbody>
                <tr>

                  <td>{{$programacion->fecha_programacion}}</td>
                  <td>{{$programacion->marca}}</td>
                  <td>{{$programacion->modelo}}</td>
                  <td>{{$programacion->placa_vehiculo}}</td>
                  <td>{{$programacion->serial_carroceria}}</td>
                  <td>{{$programacion->anio_vehiculo}}</td>
                  <td>{{$programacion->color}}</td>
                  <td>{{$programacion->taller}}</td>
                  <td>{{$programacion->nom_acueducto}}</td>
                  <td>{{$programacion->status}}</td>
                  <td>{{$programacion->observaciones_program}}</td>
                  <td>
                    <a href="{{-- {{Route('editando',$programacion->id_programacion)}} --}}">
                      <i class="fa-solid fa-pen-to-square"></i>
                    </a>
                    <a href="">
                      <i class="fa-solid fa-trash"></i>
                    </a>
                    <a href="">
                      <i class="fa-solid fa-file-pdf"></i>
                    </a>
                  </td>
                </tr>
              </tbody>
            @endforeach
          <tfoot>
            <tr>
              <th>Fecha</th>
              <th>Marca</th>
              <th>Modelo</th>
              <th>Placa</th>
              <th>Serial Carroc</th>
              <th>Año</th>
              <th>Color</th>
              <th>Taller</th>
              <th>Acued</th>
              <th>Estatus</th>
              <th>Obs</th>
              <th>Aciones</th>
            </tr>
          </tfoot>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
    @endsection