@extends('layouts.dasboard')
@section('title','Nueva Programacion')
@section('mainPage')

<div class="card">
  <div class="card-header">
        <div class="row">
          <div class="col-10">
            <h2>Listado de Proveedores</h2>
          </div>
          <div class="col-2">
           {{--  <button type="button" class="btn btn-primary" onclick="window.location.href='{{Route('nuevo.proveedor')}}'">
            <i class="nav-icon far fa-plus-square"> </i>
            <label style="margin-left: 5px; margin-right:4px;">Proveedor</label>
            </button> --}}
          </div>
        </div>

      </div>

  <div class="card-body shadow mb-4 table-responsive bg-white tabla" id="filtroTabla">
    <table id="example1" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th><p align="center">RIF</p></th>
          <th><p align="center">Nombre</p></th>
          <th><p align="center">Descripción</p></th>
          <th><p align="center">Ubicación</p></th>
          <th><p align="center">Teléfono</p></th>
          <th><p align="center">Correo</p></th>
          <th><p align="center">Estatus</p></th>
          @if(session('rol') == 1)
          <th><p align="center">Acciones</p></th>
          @endif
        </tr>
      </thead>
      <tbody>
        @foreach($lista as $proveedor)
          <tr>
            <td align="center"> {{$proveedor->rif}} </td>
            <td align="center"> {{$proveedor->nombre_proveedor}} </td>
            <td align="center"> {{$proveedor->descripcion_proveedor}} </td>
            <td align="center"> {{$proveedor->ubicacion_proveedor}} </td>
            <td align="center"> {{$proveedor->telefono_proveedor}} </td>
            <td align="center"> {{$proveedor->correo_proveedor}} </td>
            @if($proveedor->activo == true)
              <td><p style="background-color: lightblue; text-align: center;"> Activo </p></td>
            @else
              <td><p style="background-color: red; text-align: center;"> Inactivo </p></td>
            @endif
              <td>
                <abbr title="Editar">
                  <a href="{{Route('ver.proveedor',$proveedor->id_proveedor)}}">
                    <i class="fa-solid fa-pen-to-square fa-2x"></i>
                  </a>
                </abbr>

                <abbr title="Estatus">
                  <a href="{{Route('estatus.proveedor',$proveedor->id_proveedor)}}">
                    @if($proveedor->activo == true)
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
          <th><p align="center">Nombre</p></th>
          <th><p align="center">Descripción</p></th>
          <th><p align="center">Ubicación</p></th>
          <th><p align="center">Teléfono</p></th>
          <th><p align="center">Correo</p></th>
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