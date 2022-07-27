<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title')</title>

  <!-- Google Font: Source Sans Pro -->
  {{-- <link rel="stylesheet" href="{{asset('fontawesome/css/all.css')}}"> --}}
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">

  {{-- link para la libreria select2 --}}
  <link href="{{asset('select2/css/select2.min.css')}}" rel="stylesheet">
  {{-- fin :D --}}

  <link rel="stylesheet" href="{{asset('fontawesome6/css/fontawesome.min.css')}}">
  <link rel="stylesheet" href="{{asset('fontawesome6/css/brands.min.css')}}">
  <link rel="stylesheet" href="{{asset('fontawesome6/css/solid.min.css')}}">
  <!-- Ionicons -->
  
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{asset('plugins/jqvmap/jqvmap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{asset('plugins/daterangepicker/daterangepicker.css')}}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{asset('plugins/summernote/summernote-bs4.min.css')}}">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">

  <link rel="stylesheet" type="text/css" href="{{asset('DataTables/datatables.css')}}">




</head>
<body class="hold-transition sidebar-mini layout-fixed">

  {{-- {{dd(session()->all())}} --}}

  <div class="wrapper">
    {{-- cintillo --}}
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      {{-- <img src="{{asset('img/headerlogohidro.png')}}" alt="" style="width: 1500px; height:50px"> --}}
      {{-- <button type="button" class="btn btn-danger" style="margin-left:90%;">Cerrar Sesión</button> --}}
      <button class="btn btn-danger" onclick="salir()" style="margin-left:90%;" name="salir" id="salir">Cerrar Sesión</button>
    </nav>
    {{-- cintillo --}}

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="index3.html" class="brand-link">
        <img src="{{asset('dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Almacen</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="{{asset('dist/img/avatar5.png')}}" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block">{{ session('usuario') }}</a>
          </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

              <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

               <li class="nav-item">
                <a href="{{Route('inicio')}}" class="nav-link">
                  <i class="nav-icon fas fa-home-alt"></i>
                  <p>Inicio</p>
                </a>
              </li>


              @if(session('rol')==1)
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fa fa-bars"></i>
                  <p>
                    Estadisticas
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{Route('estadisticas.articulos')}}" class="nav-link">
                      <i class="fa fa-object-group" aria-hidden="true"></i>
                      <p>Familias</p>
                    </a>
                  </li>
                  {{-- <li class="nav-item">
                    <a href="{{Route('BuscarMaterial')}}" class="nav-link">
                      <i class="fa fa-search" aria-hidden="true"></i>
                      <p>Buscar Material</p>
                    </a>
                  </li> --}}
                </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fa fa-tablet"></i>
                  <p>
                    Reportes
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{Route('filtrar.reporte')}}" class="nav-link">
                      <i class="fa fa-search" aria-hidden="true"></i>
                      <p>Reportes Generales</p>
                    </a>
                  </li>
                  {{-- <li class="nav-item">
                    <a href="" class="nav-link">
                      <i class="fa fa-list" aria-hidden="true"></i>
                      <p>Registro Almacen</p>
                    </a>
                  </li> --}}
                </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fas fa-warehouse"></i>
                  <p>
                    Almacen
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{Route('listaAlmacenes')}}" class="nav-link">
                      <i class="fa fa-list-alt" aria-hidden="true"></i>
                      <p>Lista de Almacenes</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{Route('newAlmacen')}}" class="nav-link">
                      <i class="fa fa-map-marker" aria-hidden="true"></i>
                      <p>Registro Almacen</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fa fa-cubes" aria-hidden="true"></i>
                  <p>
                   Material
                   <i class="right fas fa-angle-left"></i>
                 </p>
               </a>
               <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{route('listaArticulos')}}" class="nav-link">
                    <i class="fa fa-list-alt" aria-hidden="true"></i>
                    <p>Maestro de  Materiales</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{Route('newArticulo')}}" class="nav-link">
                    <i class="fa fa-cube" aria-hidden="true"></i>
                    <p>Ingresar Material</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="fa fa-paper-plane" aria-hidden="true"></i>
                <p>
                  Proveedores
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{route('lista.proveedor')}}" class="nav-link">
                    <i class="fa fa-list-alt" aria-hidden="true"></i>
                    <p>Listado de Proveedores</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{Route('nuevo.proveedor')}}" class="nav-link">
                    <i class="fa fa-share" aria-hidden="true"></i>
                    <p>Ingresar Proveedor</p>
                  </a>
                </li>
              </ul>
            </li>

            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="fa fa-paper-plane" aria-hidden="true"></i>
                <p>
                  Familia
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
               {{--  <li class="nav-item">
                  <a href="{{route('lista.proveedor')}}" class="nav-link">
                    <i class="fa fa-list-alt" aria-hidden="true"></i>
                    <p>Listado de Proveedores</p>
                  </a>
                </li> --}}
                <li class="nav-item">
                  <a href="{{Route('nuevaFamilia')}}" class="nav-link">
                    <i class="fa fa-share" aria-hidden="true"></i>
                    <p>Ingresar Familia</p>
                  </a>
                </li>
              </ul>
            </li>

            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="fa fa-tasks" aria-hidden="true"></i>
                <p>
                  Movimientos
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{Route('entrada.lista')}}" class="nav-link">
                    <i class="fa fa-bars" aria-hidden="true"></i>
                    <p>Ver Entradas y Salidas</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{Route('newEntradaMaterial')}}" class="nav-link">
                    <i class="fa fa-paperclip" aria-hidden="true"></i>
                    <p>Entrada De Material</p>
                  </a>
                </li>
              </ul>

              {{--   <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="" class="nav-link">
                      <i class="fa fa-paperclip" aria-hidden="true"></i>
                      <p>Entrada Por Ajuste de Inventario</p>
                    </a>
                  </li>
                </ul>

                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="" class="nav-link">
                      <i class="fa fa-paperclip" aria-hidden="true"></i>
                      <p>Entrada Por Adquisicion o Compra </p>
                    </a>
                  </li>
                </ul>

                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="" class="nav-link">
                      <i class="fa fa-paperclip" aria-hidden="true"></i>
                      <p>Entrada Por Donacion </p>
                    </a>
                  </li>
                </ul> --}}

                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{Route('newMovSalida')}}" class="nav-link">
                      <i class="fa fa-paperclip" aria-hidden="true"></i>
                      <p>Salida De Material</p>
                    </a>
                  </li>
                </ul>

                {{-- <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="" class="nav-link">
                      <i class="fa fa-paperclip" aria-hidden="true"></i>
                      <p>Salida por Inversion</p>
                    </a>
                  </li>
                </ul>

                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="" class="nav-link">
                      <i class="fa fa-paperclip" aria-hidden="true"></i>
                      <p>Salida por Devolucion</p>
                    </a>
                  </li>
                </ul> --}}

                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{Route('listaMovimientos')}}" class="nav-link">
                      <i class="fa fa-paperclip" aria-hidden="true"></i>
                      <p>Solicitud de Material</p>
                    </a>
                  </li>
                </ul>

                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{route('listaMovimientos')}}" class="nav-link">
                      <i class="fa fa-paperclip" aria-hidden="true"></i>
                      <p>Traspaso de Material</p>
                    </a>
                  </li>
                </ul>

              </li>
              {{-- <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fa fa-users" aria-hidden="true"></i>
                  <p>
                    Usuarios
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{Route('lista.user')}}" class="nav-link">
                      <i class="fa fa-list-alt" aria-hidden="true"></i>
                      <p>Listar Usuarios</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{Route('nuevoUser')}}" class="nav-link">
                      <i class="fa fa-user-plus" aria-hidden="true"></i>
                      <p>Nuevo Usuario</p>
                    </a>
                  </li>
                </ul>
              </li> --}}
              @endif


            </ul>
          </nav>
          <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
          @yield('mainPage')

        </section>
        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->
      <footer class="main-footer">
        <strong>Copyright &copy; 2022 <a href="#" target="_blank">Multiservicios RM</a>.</strong>
        All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
          <b>Version</b> 3.2.0
        </div>
      </footer>

      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
      </aside>
      <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script type="text/javascript" charset="utf8" src="{{asset('DataTables/datatables.js')}}"></script>

    <script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/scripts.js')}}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- ChartJS -->
    <script src="{{asset('plugins/chart.js/Chart.min.js')}}"></script>
    <!-- Sparkline -->
    {{-- <script src="{{asset('plugins/sparklines/sparkline.js')}}"></script> --}}
    <!-- JQVMap -->
    <script src="{{asset('plugins/jqvmap/jquery.vmap.min.js')}}"></script>
    <script src="{{asset('plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{asset('plugins/jquery-knob/jquery.knob.min.js')}}"></script>
    <!-- daterangepicker -->
    <script src="{{asset('plugins/moment/moment.min.js')}}"></script>
    <script src="{{asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
    <!-- Summernote -->
    <script src="{{asset('plugins/summernote/summernote-bs4.min.js')}}"></script>
    <!-- overlayScrollbars -->
    <script src="{{asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('dist/js/adminlte.js')}}"></script>
  {{-- AdminLTE for demo purposes
  <script src="{{asset('dist/js/demo.js"></script> --}}
  {{-- Sweet Alert 2 --}}
  <script src="{{asset('js/sweetalert/sweetalert2.all.min.js')}}"></script>

  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="{{asset('dist/js/pages/dashboard.js')}}"></script>
  <!-- DataTables  & Plugins -->
  <script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
  <script src="{{asset('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
  <script src="{{asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
  <script src="{{asset('plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
  <script src="{{asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
  <script src="{{asset('plugins/jszip/jszip.min.js')}}"></script>
  <script src="{{asset('plugins/pdfmake/pdfmake.min.js')}}"></script>
  <script src="{{asset('plugins/pdfmake/vfs_fonts.js')}}"></script>
  <script src="{{asset('plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
  <script src="{{asset('plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
  <script src="{{asset('plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
  <script src="{{asset('select2/js/select2.min.js')}}"></script>
  <script>

    // $(document).ready(function() {
    //   $('.js-example-basic-single').select2();
    // });

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

    function salir(){
      // $('#salir').submit(function(e){
      //   e.preventDefault();

      Swal.fire({
        title: 'Cerrar Sesión',
        text: "¿Está seguro que desea cerrar sesión?",
        icon: 'info',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Cerrar Sesion'
      }).then((result) => {
        console.log(result)

        if (result.value) {
            // Swal.fire(
            //   'Deleted!',
            //   'Your file has been deleted.',
            //   'success'
            // )
            // this.submit();
            window.location.href='/salir';
          }
        })
    }
  </script>

</body>
</html>
