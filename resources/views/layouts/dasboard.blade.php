<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title')</title>

  <!-- Google Font: Source Sans Pro -->
  {{-- <link rel="stylesheet" href="{{asset('fontawesome/css/all.css')}}"> --}}
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">

  {{-- link para la libreria select2 --}}
  <link href="{{asset('select2/css/select2.min.css')}}" rel="stylesheet">
  {{-- fin :D --}}

  <link rel="stylesheet" href="{{asset('fontawesome6/css/fontawesome.min.css')}}">
  <link rel="stylesheet" href="{{asset('fontawesome6/css/brands.min.css')}}">
  <link rel="stylesheet" href="{{asset('fontawesome6/css/solid.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
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



</head>
  <body class="hold-transition sidebar-mini layout-fixed">

    {{-- {{dd(session()->all())}} --}}

    <div class="wrapper">
    {{-- cintillo --}}
      <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        {{-- <img src="{{asset('img/headerlogohidro.png')}}" alt="" style="width: 1500px; height:50px"> --}}
        {{-- <button type="button" class="btn btn-danger" style="margin-left:90%;">Cerrar Sesión</button> --}}
        <button class="btn btn-danger" onclick="window.location.href='/salir'" style="margin-left:90%;">Cerrar Sesión</button>
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
                  <i class="fas fa-warehouse"></i>
                  <p>
                    Almacen
                  <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{Route('listaAlmacenes')}}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Lista de Almacenes</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fa fa-cubes" aria-hidden="true"></i>
                  <p>
                     Articulos
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{route('listaArticulos')}}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Lista de Articulo</p>
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
                      <i class="far fa-circle nav-icon"></i>
                      <p>Lista de  Proveedor</p>
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
                    <a href="{{route('listaMovimientos')}}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Solicitud</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{Route('newArticulo')}}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Ingresar Material</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{Route('newAlmacen')}}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Ingresar Almacen</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{Route('nuevo.proveedor')}}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Ingresar Proveedor</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{Route('traspasoAlmacen')}}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Traspaso entre Almacenes</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
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
                    <a href="{{Route('nuevo.user')}}" class="nav-link">
                      <i class="fa fa-user-plus" aria-hidden="true"></i>
                      <p>Nuevo Usuario</p>
                    </a>
                  </li>
                </ul>
              </li>
              @endif

              @if(session('rol')==0)
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
                      <i class="far fa-circle nav-icon"></i>
                      <p>Lista de Almacenes</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fa fa-cubes" aria-hidden="true"></i>
                  <p>
                    Articulos
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{route('listaArticulos')}}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Lista de Articulo</p>
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
                      <i class="far fa-circle nav-icon"></i>
                      <p>Lista de  Proveedor</p>
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
                    <a href="{{route('listaMovimientos')}}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Solicitud</p>
                    </a>
                  </li>
                </ul>
              </li>
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
        <strong>Copyright &copy; 2022 <a href="https://hidrocapital.com.ve" target="_blank">Hidrocapital</a>.</strong>
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

  $(document).ready(function() {
    $('.js-example-basic-single').select2();
  });

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
</script>
  </body>
</html>