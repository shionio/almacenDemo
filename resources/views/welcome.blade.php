@extends('layouts.dasboard')
@section('title','Inicio')
@section('mainPage')
  <div class="offset-4 col-2">
    @if(Session::has('msg'))
      <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
          {{Session::get('msg')}}
      </div>
    @endif
  </div>

	<div class="card">
    <div class="card-header">
      <div class="row">
        <div class="col-10">
          <h2>Listado de Artículos</h2>
        </div>
      </div>
    </div>

      <!-- /.card-header -->
      <div class="card">
        <div class="card-header">
          <div class="card-body row">
            <div class="col form-group" >
              <input type="text" class="form-control" id="filtroBusqueda" name="filtro" onkeyup="filtro()" placeholder="Filtrar">
            </div>
          </div>
        </div>
      </div>


      <div class="card-body">
        <table id="filtroTabla" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>Id</th>
              <th>Nombre</th>
              <th>Almacen</th>
              <th>Stock</th>
              <th>Descripcion</th>
              <th>Unidad de Medida</th>
              {{-- @if(session('rol')==1)
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
                    <td>{{$articulo->descripcion_almacen}}</td>
                    <td>{{$articulo->stock}}</td>
                    <td>{{$articulo->descripcion_material}}</td>
                    <td>{{$articulo->unidad_medida}}</td>
                    {{-- @if(session('rol')==1)
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
                    @endif --}}
                  </tr>
              @else
                <tr>
                    <td>{{$articulo->id_material}}</td>
                    <td>{{$articulo->nombre_material}}</td>
                    <td>{{$articulo->descripcion_almacen}}</td>
                    <td>{{$articulo->stock}}</td>
                    <td>{{$articulo->descripcion_material}}</td>
                    <td>{{$articulo->unidad_medida}}</td>
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
              <th>Nombre</th>
              <th>Almacen</th>
              <th>Stock</th>
              <th>Descripcion</th>
              <th>Unidad de Medida</th>
             {{--  @if(session('rol')==1)
              <th>Acciones</th>
              @endif --}}
            </tr>
          </tfoot>
        </table>

        <div id="mostrarDatos" style="display:none;">
          {{-- {{$data->render()}} --}}
        </div>

      </div>
      <!-- /.card-body -->
    </div>

    <script type="text/javascript">

      function filtro(){

            var valorFiltro = $('#filtroBusqueda').val()
            //console.log(valorFiltro)
            var tamanoFiltro = valorFiltro.length

            if (tamanoFiltro > 2){
                $.ajax({
                        url : '/material/filtroLista',
                        type: 'POST',
                        dataType : 'JSON',
                        data : {
                            "_token": "{{ csrf_token() }}",
                            palabraClave : valorFiltro,
                        },
                    success: function(resultado){
                      console.log(resultado)
                        var html = "<div class='card-body shadow mb-4 table-responsive bg-white tabla' id='filtroTabla'><table class='table' id='dataTable' width='100%' cellspacing='0'><thead class='text-center'><tr><th>ID</th><th>Nombre Material</th><th>Almacen</th><th>Stock</th><th>Descripcion</th><th>Unidad de Medida</th><th>Accion</th></tr></thead>"
                        // for(i=0; i<resultado.length; i++){
                        //     html+="<tr><td>"+resultado[i]['cod_reporte']
                        //     +"</td> <td>"+resultado[i]['fecha_crea']
                        //     +"</td> <td>"+resultado[i]['nic']
                        //     +"</td> <td>"+resultado[i]['nom_cliente']+" "+resultado[i]['ape_cliente']
                        //     +"</td> <td>"+resultado[i]['telefono']
                        //     +"</td> <td> Municipio. "+resultado[i]['nom_mpio']+" Parroquia. "+resultado[i]['nom_parroq']+" Sector. "+resultado[i]['nom_sector']
                        //     +"</td> <td>"+resultado[i]['nom_acueducto']
                        //     +"</td> <td>"+resultado[i]['nom_categ']+" - "+resultado[i]['nom_subcateg']
                        //     +"</td> <td>"+resultado[i]['observaciones']
                        //     +"</td> <td>"+resultado[i]['nombreoperador']+" "+resultado[i]['apellidooperador']
                        //     +"</td> <td>"+resultado[i]['descrip_estatu']

                        //     +"</td> <td><button class='btn btn-primary' name='cod_reporte' value='imprimir pdf' onclick='pdf("+resultado[i]['cod_reporte']+")'><i class='fas fa-file-pdf'></i></</button> <button class='btn btn-success' name='edit_reporte' value='Edit Reporte' onclick='mostrarReporteEdit("+resultado[i]['cod_reporte']+")'><i class='fas fa-edit'></i></</button> </td></tr></div>"
                        // }
                        $('#filtroTabla').hide()
                        $('#mostrarDatos').css('display', '')
                        $('#mostrarDatos').html(html)
                        $('#total').html('<b>Total de Registros:</b> '+resultado.length)

                    }
                })
            }else if(tamanoFiltro == ''){
              location.reload()
            }
        }
    </script>
@endsection
