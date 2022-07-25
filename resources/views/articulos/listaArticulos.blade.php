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
        {{-- {{dd($materiales)}} --}}
        <table class="table">
          <thead class="thead-dark">
            <tr>
              <th>CODIGO</th>
              <th>DESCRIPCION</th>
              <th>UNIDAD MEDIDA</th>
              <th>CONDICION</th>
              <th>ALMACEN</th>
              <th>STOCK ALMACEN</th>
              <th>CENTRO</th>
              <th>IMAGEN</th>

             {{--  @if(session('rol')==1)
                <th>Acciones</th>
              @endif --}}
            </tr>
          </thead>
            @foreach($materiales as $mat)
              {{-- {{dd($mat)}} --}}
                <tbody>
                  <tr>
                    <td>{{$mat->codigo}}</td>
                    <td>{{$mat->descripcion_propuesta}}</td>
                    <td>{{$mat->unidad_medida}}</td>
                    <td>{{$mat->descrip_condicion_material}}</td>
                    <td>{{$mat->nombre_almacen}}</td>
                    @if($mat->suma < 200)
                    <td style="background-color: red;">{{$mat->suma}}</td>
                    @else
                    <td>{{$mat->suma}}</td>
                    @endif
                    <td>{{$mat->centro}}</td>
                    <td>
                      {{-- <img src="{{asset($materiales->img_material)}}" alt=""> --}}
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
            @endforeach
          <tfoot class="thead-dark">
            <tr>
              <th>CODIGO</th>
              <th>DESCRIPCION</th>
              <th>UNIDAD MEDIDA</th>
              <th>CONDICION</th>
              <th>ALMACEN</th>
              <th>STOCK ALMACEN</th>
              <th>CENTRO</th>
              <th>IMAGEN</th>
              {{-- @if(session('rol')==1)
              <th>Acciones</th>
              @endif --}}
            </tr>
          </tfoot>
        </table>
        {{$materiales->render()}}
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
    <script type="text/javascript">
      $(function () {
        $("#example1").DataTable({
          "responsive": true, "lengthChange": false, "autoWidth": false,
          "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false,
          "responsive": true,
        });
      });

      function hola(){
        alert('xD')
      }
    </script>
    @endsection