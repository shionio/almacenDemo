@extends('layouts.dasboard')
@section('title','Total Artículos')
@section('mainPage')



<div class="card">
  <div class="card-header">
    <div class="row">
      <div class="col-6">
        <label>SELECCIONE FAMILIA</label>
        <select class="js-example-basic-single custom-select" name="familia" id="familia" onchange="llenarMaterial()">
          <option value="">FAMILIA</option>
          @foreach($fam as $familia)
          <option value="{{$familia->id_familia}}">{{$familia->nombre_familia}}</option>
          @endforeach
        </select>
      </div>
      <div>
        <label>SELECCIONE MATERIAL</label>
        <select class="js-example-basic-single custom-select" name="material" id="material" required>
          <option value="null">Seleccione</option>
        </select>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
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
        success:function(municipios){
        //   var municipios = $.parseJSON(municipios)
        //   $('#municipio').empty()
        //   $("#municipio").append("<option value='null'>Seleccione</option>")
        //   for (var i = 0; i < municipios.length; i++){
        //     $("#municipio").append("<option value='"+municipios[i].id_municipio+"'>"+municipios[i].municipio+"</option>")
        //   }
        // }
      })
    }
  </script>

  @endsection