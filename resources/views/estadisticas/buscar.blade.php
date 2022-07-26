@extends('layouts.dasboard')
@section('title','Total Artículos')
@section('mainPage')



<div class="card">
  <div class="card-header">
    <div class="row">
      <div class="col-sm-12">
        <h3 align="center">BÚSQUEDA AVANZADA</h3>
      </div>
      <div class="col-sm-3">
        <form action="{{Route('estadisticas.barrasFil')}}" method="POST">
          @csrf
          <label>SELECCIONE FAMILIA</label>
          <select class="js-example-basic-single custom-select" name="familia" id="familia" onchange="llenarMaterial()">
            <option value="null">FAMILIA</option>
            @foreach($fam as $familia)
            <option value="{{$familia->id_familia}}">{{$familia->nombre_familia}}</option>
            @endforeach
          </select>
        </div>
        <div class="col-sm-3">
          <label>SELECCIONE MATERIAL</label>
          <select class="js-example-basic-single custom-select" name="material" id="material" required>
            <option value="null">Seleccione</option>
          </select>
        </div>
        <div class="col-3" align="center" style="margin-top: 30px;">
          <input type="submit" name="aceptar" class="btn btn-primary" value="BUSCAR">
        </div>
      </form>
    </div>
  </div>
</div>
</div>







<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<script src="{{asset('select2/js/select2.min.js')}}"></script>
<script type="text/javascript">

  $(document).ready(function() {
    $('.js-example-basic-single').select2();
  });

  function llenarMaterial(){
    var familia = $('#familia').val()
      //console.log(estado)
      $.ajax({
        url : '/llenar/material',
        type : 'post',
        data :  {
          id_familia : familia,
          "_token": "{{ csrf_token() }}"
        },
        success:function(materiales){
          // var materiales = $.parseJSON(materiales)
          $('#material').empty()
          $("#material").append("<option value='null'>Seleccione</option>")
          for (var i = 0; i < materiales.length; i++){
            $("#material").append("<option value='"+materiales[i].id_material+"'>"+materiales[i].descripcion_propuesta+"</option>")
          }
        }
      })
    }
  </script>

  @endsection