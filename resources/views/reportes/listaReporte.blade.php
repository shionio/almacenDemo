@extends('layouts.dasboard')
@section('title','Busqueda Avanzada')
@section('mainPage')

{{-- {{dd($datos, $table)}} --}}
<div class="card">
	<div class="card-header">
		<div class="row">
			<div class="col-6">
				<h2>REPORTES GENERALES</h2>
			</div>
		</div>
	</div>
	<!-- /.card-header -->
		<div class="card-body shadow mb-4 table-responsive bg-white tabla" id="filtroTabla">
		{{-- {{dd($materiales)}} --}}
		<table class="table">
			<thead class="thead-dark">
				<tr>
					@foreach($table as $key => $value)
					@switch($value)
					@case('nombre_almacen')
					<th>Nombre Almacen</th>
					@break
					@case('siglas_almacen')
					<th>Siglas</th>
					@break
					@case('centro')
					<th>Centro</th>
					@break
					@case('nombre_familia')
					<th>Familia</th>
					@break
					@case('sum')
					<th>Stock Almacén</th>
					@break
					@case('descripcion_propuesta')
					<th>Descripción</th>
					@break
					@case('codigo')
					<th>Código</th>
					@break
					@case('unidad_medida')
					<th>Medida</th>
					@break
					@case('desc_estatus_material')
					<th>Estatus Material</th>
					@break
					@case('descrip_condicion_material')
					<th>Condición Material</th>
					@break
					@case('stock')
					<th>Stock</th>
					@break
					@endswitch
					@endforeach
				</tr>
			</thead>
			<tbody name="datos" id="datos">
					@foreach($datos as $key => $value)
				<tr>
					<th>{{$value->nombre_almacen}}</th>
					<th>{{$value->siglas_almacen}}</th>
					<th>{{$value->centro}}</th>
					<th>{{$value->nombre_familia}}</th>
					<th>{{$value->sum}}</th>
					<th>{{$value->descripcion_propuesta}}</th>
					<th>{{$value->codigo}}</th>
					<th>{{$value->unidad_medida}}</th>
					<th>{{$value->desc_estatus_material}}</th>
					<th>{{$value->descrip_condicion_material}}</th>
					<th>{{$value->stock}}</th>
				</tr>
					@endforeach

			</tbody>
			<tfoot class="thead-dark">
				
				<tr>
					@foreach($table as $key => $value)
					@switch($value)
					@case('nombre_almacen')
					<th>Nombre Almacen</th>
					@break
					@case('siglas_almacen')
					<th>Siglas</th>
					@break
					@case('centro')
					<th>Centro</th>
					@break
					@case('nombre_familia')
					<th>Familia</th>
					@break
					@case('sum')
					<th>Stock Almacén</th>
					@break
					@case('descripcion_propuesta')
					<th>Descripción</th>
					@break
					@case('codigo')
					<th>Código</th>
					@break
					@case('unidad_medida')
					<th>Medida</th>
					@break
					@case('desc_estatus_material')
					<th>Estatus Material</th>
					@break
					@case('descrip_condicion_material')
					<th>Condición Material</th>
					@break
					@case('stock')
					<th>Stock</th>
					@break
					@endswitch
					@endforeach
				</tr>

			</tfoot>
		</table>
		<br>
		{{-- {{$datos->render()}} --}}
	</div>
	<!-- /.card-body -->
</div>

<script type="text/javascript">
	// function filtro(){

 //            var valorFiltro = $('#filtroBusqueda').val()
 //            console.log(valorFiltro)
 //            var tamanoFiltro = valorFiltro.length
            
 //            if (tamanoFiltro > 2){
 //                $.ajax({
 //                        url : '/potable/filtroLista',
 //                        type: 'POST',
 //                        dataType : 'JSON',
 //                        data : {
 //                            "_token": "{{ csrf_token() }}",
 //                            palabraClave : valorFiltro,
 //                        },
 //                    success: function(resultado){
 //                    	console.log(resultado)
 //                        var html = "<tbody name='datos' id='datos'>"
 //                        for(i=0; i<resultado.length; i++){
 //                            html+="<tr><td>"+resultado[i]['cod_reporte']
 //                            +"</td> <td>"+resultado[i]['fecha_crea']
 //                            +"</td> <td>"+resultado[i]['nic']
 //                            +"</td> <td>"+resultado[i]['nom_cliente']+" "+resultado[i]['ape_cliente']
 //                            +"</td> <td>"+resultado[i]['telefono']
 //                            +"</td> <td> Municipio. "+resultado[i]['nom_mpio']+" Parroquia. "+resultado[i]['nom_parroq']+" Sector. "+resultado[i]['nom_sector']
 //                            +"</td> <td>"+resultado[i]['nom_acueducto']
 //                            +"</td> <td>"+resultado[i]['nom_categ']+" - "+resultado[i]['nom_subcateg']
 //                            +"</td> <td>"+resultado[i]['observaciones']
 //                            +"</td> <td>"+resultado[i]['nombreoperador']+" "+resultado[i]['apellidooperador']
 //                            +"</td> <td>"+resultado[i]['descrip_estatu']

 //                            +"</td> <td><button class='btn btn-primary' name='cod_reporte' value='imprimir pdf' onclick='pdf("+resultado[i]['cod_reporte']+")'><i class='fas fa-file-pdf'></i></</button> <button class='btn btn-success' name='edit_reporte' value='Edit Reporte' onclick='editarReporte("+resultado[i]['cod_reporte']+")'><i class='fas fa-edit'></i></</button> </td></tr></div>"
 //                        }
 //                       	$('#filtroTabla').hide()
 //                       	$('#mostrarDatos').css('display', '')
 //                        $('#mostrarDatos').html(html)
 //                        $('#total').html('<b>Total de Registros:</b> '+resultado.length)

 //                    }
 //                })
 //            }else if(tamanoFiltro == ''){
 //            	location.reload()
 //            }
 //        }
</script>


@endsection