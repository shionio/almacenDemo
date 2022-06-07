@extends('layouts.dasboard')
@section('title','Nueva Programacion')
@section('mainPage')

<div class="card">
  <div class="card-header">
        <div class="row">
          <div class="col-10">
            <h2>Listado de Usuarios</h2>
          </div>
          <div class="col-2">
           {{--  <button type="button" class="btn btn-primary" onclick="window.location.href='{{Route('nuevo.usuario')}}'">
            <i class="nav-icon far fa-plus-square"> </i>
            <label style="margin-left: 5px; margin-right:4px;">usuario</label>
            </button> --}}
          </div>
        </div>

      </div>

  <div class="card-body shadow mb-4 table-responsive bg-white tabla" id="filtroTabla">
    <table id="example1" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th><p align="center">ID</p></th>
          <th><p align="center">Cedula</p></th>
          <th><p align="center">Nombre y Apellido</p></th>
          <th><p align="center">Cargo</p></th>
          <th><p align="center">Usuario</p></th>
          <th><p align="center">Rol Asignado</p></th>
          <th><p align="center">Estatus</p></th>
          @if(session('rol') == 1)
          <th><p align="center">Acciones</p></th>
          @endif
        </tr>
      </thead>
      <tbody>
        @foreach($lista as $usuario)
          <tr>
            <td align="center"> {{$usuario->id_usuario}} </td>
            <td align="center"> {{$usuario->cedula}} </td>
            <td align="center"> {{$usuario->nombre}} {{$usuario->apellido}} </td>
            <td align="center"> {{$usuario->cargo}} </td>
            <td align="center"> {{$usuario->usuario}} </td>
            <td align="center"> {{$usuario->nombre_rol}} </td>
            @if($usuario->activo == true)
              <td><p style="background-color: lightblue; text-align: center;"> Activo </p></td>
            @else
              <td><p style="background-color: red; text-align: center;"> Inactivo </p></td>
            @endif
              <td>
                <abbr title="Editar">
                  <a href="{{-- {{Route('ver.usuario',$usuario->id_usuario)}} --}}">
                    <i class="fa-solid fa-pen-to-square fa-2x"></i>
                  </a>
                </abbr>

                <abbr title="Estatus">
                  <a href="{{-- {{Route('estatus.usuario',$usuario->id_usuario)}} --}}">
                    @if($usuario->activo == true)
                      <i class="fa fa-toggle-on fa-2x" aria-hidden="true"></i>
                    @else
                      <i class="fa fa-toggle-off fa-2x" aria-hidden="true"></i>
                    @endif
                  </a>
                </abbr>
              </td>
          </tr>
        @endforeach
      </tbody>
      <tfoot>
        <tr>
          <th><p align="center">RIF</p></th>
          <th><p align="center">Cedula</p></th>
          <th><p align="center">Nombre y Apellido</p></th>
          <th><p align="center">Cargo</p></th>
          <th><p align="center">Usuario</p></th>
          <th><p align="center">Rol Asignado</p></th>
          <th><p align="center">Estatus</p></th>
          <th><p align="center">Acciones</p></th>
        </tr>
      </tfoot>
    </table>
  </div>
</div>
  <script type="text/javascript">

  </script>

@endsection