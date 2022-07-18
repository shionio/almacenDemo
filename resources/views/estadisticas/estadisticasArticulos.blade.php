@extends('layouts.dasboard')
@section('title','Total Artículos')
@section('mainPage')

{{-- {{dd($final, $total, $fam)}} --}}

<link href="{{ asset('/css/graficos.css') }}" rel="stylesheet">
<section>

{{-- {{dd($total)}} --}}

<h3>TOTAL MATERIALES ({{$final}}) POR FAMILIAS</h3>
  <div class="chart-container">
    <div class="base"></div>
        <!-- Left Side Meter-->
    {{-- <ul class="meter">
      <li><div>{{round($final*1)}}</div></li>
      <li><div>{{round($final*0.80)}}</div></li>
      <li><div>{{round($final*0.60)}}</div></li>
      <li><div>{{round($final*0.40)}}</div></li>
      <li><div>{{round($final*0.20)}}</div></li>
    </ul> --}}
    <!-- Background-Grid -->
    
    <!-- End Background Grid -->
    
    @foreach($total as $i => $familias)
    <a href="{{Route('estadisticas.barras',$familias->id_familia)}}">
    <div class="bar two" style="height: {{$familias->suma/$final*100}}%; left: {{$i*10}}%;">{{$familias->suma}} {{$familias->nombre_familia}}</div></a>
    {{-- <div style="height: 0px; left: {{$i*10}}%;">
        {{$material->stock}}
    </div> --}}
    @endforeach
    <a href="">
    <div class="bar two" style="height: 52%; left: 30%;">152465 HIERROS</div></a>
    <a href="">
    <div class="bar two" style="height: 24%; left: 40%;">52366 CABLES</div></a>
    <a href="">
    <div class="bar two" style="height: 72%; left: 50%;">52366 TRANSFORMADORES</div></a>
  </div>

</section>               

@endsection