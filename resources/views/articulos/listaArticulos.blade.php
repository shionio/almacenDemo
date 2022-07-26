@extends('layouts.dasboard')
@section('title','Maestro de Materiales')
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
          <th>ACCIONES</th>

             {{--  @if(session('rol')==1)
                <th>Acciones</th>
                @endif --}}
              </tr>
            </thead>
            @foreach($materiales as $mat)
            <tbody>
              <tr>
                <td>{{$mat->codigo}}</td>
                <td @if($mat->activo == false) style="background-color: yellow;" @endif>{{$mat->descripcion_propuesta}}</td>
                <td>{{$mat->unidad_medida}}</td>
                <td>{{$mat->descrip_condicion_material}}</td>
                <td>{{$mat->nombre_almacen}}</td>
                @if($mat->suma < 200)
                <td style="background-color: red;">{{$mat->suma}}</td>
                @else
                <td>{{$mat->suma}}</td>
                @endif
                <td>{{$mat->centro}}</td>
                @if(session('rol')==1)
                <td>
                  <a href="{{Route('verArticulo',$mat->id_material)}}">
                    <i class="fas fa-edit fa-2x" style="margin-right: 5px;"></i>
                  </a>

                  <abbr title="Estatus">
                    <a href="{{Route('blockArt',['id'=>$mat->id_material,'id2'=>$mat->id_almacen])}}">
                      @if($mat->activo == true)
                      <i class="fa fa-toggle-on fa-2x" aria-hidden="true"></i>
                      @else
                      <i class="fa fa-toggle-off fa-2x" aria-hidden="true"></i>
                      @endif
                    </a>
                  </abbr>
                </td>
                @endif
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
                <th>ACCIONES</th>
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