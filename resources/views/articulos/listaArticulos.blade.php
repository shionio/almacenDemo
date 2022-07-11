@extends('layouts.dasboard')
  @section('title','Articulos')
    @section('mainPage')
    <div class="card">
      <div class="card-header">
        <div class="row">
          <div class="col-10">
            <h2>Maestro de Materiales</h2>
          </div>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        {{-- {{dd($articulos)}} --}}
        <table {{-- id="example1" --}} class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>Id</th>
              <th>Material</th>
              <th>Descripcion Material</th>
              <th>Unidad de Medida</th>
              <th>Condicion Material</th>
              <th>Sector del Material</th>
              <th>centro</th>
              <th>Almacen</th>
              <th>Stock por Almacen</th>
              <th>Stock por Centro</th>
              <th>Imagen</th>

             {{--  @if(session('rol')==1)
                <th>Acciones</th>
              @endif --}}
            </tr>
          </thead>
            @foreach($articulos as $articulo)
              @if($articulo->stock < 10)
                <tbody>
                  <tr style="background-color: orange ;">
                    <td>{{$articulo->id_material}}</td>
                    <td>{{$articulo->nombre_material}}</td>
                    <td>{{$articulo->descripcion_material}}</td>
                    <td>{{$articulo->unidad_medida}}</td>
                    <td>{{$articulo->stock}}</td>
                    <td>{{$articulo->descripcion_almacen}}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    @if(session('rol')==1)
                      <td>
                        <a href="">
                          <i class="fas fa-edit" style="margin-right: 5px;"></i>
                        </a>
                        <a href="">
                          <i class="fas fa-eye" style="margin-right: 5px;"></i>
                        </a>

                        <a href="">
                          <i class="fas fa-plus-circle" style="margin-right: 5px;"></i>
                        </a>
                    @endif
                  </tr>
              @else
                <tr>
                    <td>{{$articulo->id_material}}</td>
                    <td>{{$articulo->nombre_material}}</td>
                    <td>{{$articulo->descripcion_material}}</td>
                    <td>{{$articulo->stock}}</td>
                    <td>{{$articulo->unidad_medida}}</td>
                    <td>{{$articulo->descripcion_almacen}}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>
                      <img src="{{asset($articulo->img_material)}}" alt="">
                    </td>
                      {{-- @if(session('rol')==1)
                        <td>
                          <a href="" onclick="hola()">
                            <i class="fas fa-edit" style="margin-right: 5px;"></i>
                          </a>
                          <a href="">
                            <i class="fas fa-eye" style="margin-right: 5px;"></i>
                          </a>

                          <a href="">
                            <i class="fas fa-plus-circle" style="margin-right: 5px;"></i>
                          </a>
                        </td>
                      @endif --}}
                  </tr>
                </tbody>
              @endif
            @endforeach
          <tfoot>
            <tr>
               <th>Id</th>
              <th>Material</th>
              <th>Descripcion Material</th>
              <th>Unidad de Medida</th>
              <th>Condicion Material</th>
              <th>Sector del Material</th>
              <th>centro</th>
              <th>Almacen</th>
              <th>Stock por Almacen</th>
              <th>Stock por Centro</th>
              <th>Imagen</th>
              {{-- @if(session('rol')==1)
              <th>Acciones</th>
              @endif --}}
            </tr>
          </tfoot>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
    <script type="text/javascript">
      function hola(){
        alert('xD')
      }
    </script>
    @endsection