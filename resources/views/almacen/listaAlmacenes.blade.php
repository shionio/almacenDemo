@extends('layouts.dasboard')
  @section('title','Almacenes')
    @section('mainPage')
    <div class="card">
      <div class="card-header">
        <div class="row">
          <div class="col-10">
            <h2>Listado de Almacenes</h2>
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
        <table class="table">
          <thead class="thead-dark">
            <tr>
              <th>Id</th>
              <th>Region</th>
              <th>Estado</th>
              <th>Centro</th>
              <th>Siglas del Almacen</th>
              <th>Denominación Almacen</th>
            </tr>
          </thead>
            @foreach($almacenes as $almacen)
              <tbody>
                <tr>
                  <td>{{$almacen->id_almacen}}</td>
                  <td>{{$almacen->region}}</td>
                  <td>{{$almacen->estado}}</td>
                  <td>{{$almacen->centro}}</td>
                  <td>{{$almacen->siglas_almacen}}</td>
                  <td>{{$almacen->nombre_almacen}}</td>
                  {{-- @if($almacen->activo == true)
                    <td style="background-color:lightblue;">Activo</td>
                  @else
                    <td style="background-color:lightyellow;">Inactivo</td>
                  @endif --}}
                  {{-- <td>
                    <abbr title="Editar">
                      <a onclick="editar({{$almacen->id_almacen}})">
                    <a href="{{Route('VerAlmacen',$almacen->id_almacen)}}" type="submit" name="editar" id="editar">
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
                  </td> --}}

                </tr>
              </tbody>
            @endforeach
          <tfoot>
            <tr>
              <th>Id</th>
              <th>Region</th>
              <th>Estado</th>
              <th>centro</th>
              <th>Siglas del Almacen</th>
              <th>Denominación Almacen</th>
            </tr>
          </tfoot>
        </table><br>
        {{$almacenes->render()}}
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
        
        function editar(id_almacen){

          Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
              }).then((result) => {
                if (result.value) {
              // Swal.fire(
              //   'Deleted!',
              //   'Your file has been deleted.',
              //   'success'
              // )
              window.location.href='/Almacen/Ver/'+id_almacen;
            }
          })
        }

    </script>
    @endsection