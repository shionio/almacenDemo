@extends('layouts.dasboard')
  @section('title','Vehiculos')
    @section('mainPage')
    <div class="card">
      <div class="card-header">
        <div class="row">
          <div class="col-10">
            <h3 class="card-title">Listado de Vehiculos</h3>
          </div>
{{-- {{$vehiculos}} --}}
          <div class="col-2">
            <button type="button" class="btn btn-primary" onclick="window.location.href='{{Route('newVehiculo')}}'">
            <i class="nav-icon far fa-plus-square"> </i>
            <label style="margin-left: 5px; margin-right:2px;">Vehiculo</label>
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
              <th>Placa</th>
              <th>Marca</th>
              <th>Modelo</th>
              <th>Serial Carroc</th>
              <th>Año</th>
              <th>Color</th>
              <th>Kilometraje</th>
              <th>Estatus</th>
              <th>Acued</th>
              <th>Aciones</th>
            </tr>
          </thead>
            @foreach($vehiculos as $vehiculo)
              <tbody>
                <tr>
                  <td>{{$vehiculo->placa_vehiculo}}</td>
                  <td>{{$vehiculo->marca}}</td>
                  <td>{{$vehiculo->modelo}}</td>
                  <td>{{$vehiculo->serial_carroceria}}</td>
                  <td>{{$vehiculo->anio_vehiculo}}</td>
                  <td>{{$vehiculo->color}}</td>
                  <td>{{$vehiculo->kilometraje}}</td>
                  <td>{{$vehiculo->status_vehiculo}}</td>
                  <td>{{$vehiculo->nom_acueducto}}</td>
                  <td>
                    <a href="{{-- {{Route('editando',$vehiculo->id_programacion)}} --}}">
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
               <th>Placa</th>
              <th>Marca</th>
              <th>Modelo</th>
              <th>Serial Carroc</th>
              <th>Año</th>
              <th>Color</th>
              <th>Kilometraje</th>
              <th>Estatus</th>
              <th>Acued</th>
              <th>Aciones</th>
            </tr>
          </tfoot>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
    @endsection