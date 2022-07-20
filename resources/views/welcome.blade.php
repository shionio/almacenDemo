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
      <img src="{{asset('img/dashboard.jpg')}}" alt="">
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
                        var html = "<div class='card-body' id='filtroTabla'><table id='filtroTabla' class='table table-bordered table-striped'><thead><tr><th>ID</th><th>Nombre Material</th><th>Almacen</th><th>Stock</th><th>Descripcion</th><th>Unidad de Medida</th></tr></thead>"
                        for(i=0; i<resultado.length; i++){
                            html+="<tr><td>"+resultado[i]['id_material']
                            +"</td> <td>"+resultado[i]['nombre_material']
                            +"</td> <td>"+resultado[i]['descripcion_almacen']
                            +"</td> <td>"+resultado[i]['stock']
                            +"</td> <td>"+resultado[i]['descripcion_material']
                            //+"</td> <td> Municipio. "+resultado[i]['nom_mpio']+" Parroquia. "+resultado[i]['nom_parroq']+" Sector. "+resultado[i]['nom_sector']
                            +"</td> <td>"+resultado[i]['unidad_medida']
                            // +"</td> <td>"+resultado[i]['nom_categ']+" - "+resultado[i]['nom_subcateg']
                            // +"</td> <td>"+resultado[i]['observaciones']
                            // +"</td> <td>"+resultado[i]['nombreoperador']+" "+resultado[i]['apellidooperador']
                            // +"</td> <td>"+resultado[i]['descrip_estatu']

                            // +"</td> <td><button class='btn btn-primary' name='cod_reporte' value='imprimir pdf' onclick='pdf("+resultado[i]['cod_reporte']+")'><i class='fas fa-file-pdf'></i></</button> <button class='btn btn-success' name='edit_reporte' value='Edit Reporte' onclick='mostrarReporteEdit("+resultado[i]['cod_reporte']+")'><i class='fas fa-edit'></i></</button> </td></tr></div>"
                        }
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
