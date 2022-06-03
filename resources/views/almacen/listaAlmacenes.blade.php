@extends('layouts.dasboard')
  @section('title','Almacenes')
    @section('mainPage')
    <div class="card">
      <div class="card-header">
        <div class="row">
          <div class="col-10">
            <h2>Listado de Almacenes</h2>

            {{-- {{dd($almacenes);}} --}}
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
                    <td style="background-color:lightblue;">Activo</td>
                  @else
                    <td style="background-color:lightyellow;">Inactivo</td>
                  @endif
                  <td>
                    <abbr title="Editar">
                    <a href="{{Route('VerAlmacen',$almacen->id_almacen)}}">
                      <i class="fa-solid fa-pen-to-square fa-2x"></i>
                    </a>
                  </abbr>

                  <abbr title="Estatus">
                    <a href="{{Route('estatusAlmacen',$almacen->id_almacen)}}">
                      @if($almacen->activo == true)
                      <i class="fa fa-toggle-on fa-2x" aria-hidden="true"></i>
                      @else
                      <i class="fa fa-toggle-off fa-2x" aria-hidden="true"></i>
                      @endif
                    </a>
                  </abbr>
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