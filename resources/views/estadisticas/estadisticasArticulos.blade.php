@extends('layouts.dasboard')
@section('title','Total Artículos')
@section('mainPage')

{{-- {{dd($art, $total)}} --}}

<link href="{{ asset('/css/graficos.css') }}" rel="stylesheet">
<section>

{{-- {{dd($total)}} --}}

<h3>TOTAL MATERIALES POR FAMILIAS</h3>
  <div class="chart-container">
    <div class="base"></div>
        <!-- Left Side Meter-->
    <ul class="meter">
      <li><div>{{round($final*1)}}</div></li>
      <li><div>{{round($final*0.80)}}</div></li>
      <li><div>{{round($final*0.60)}}</div></li>
      <li><div>{{round($final*0.40)}}</div></li>
      <li><div>{{round($final*0.20)}}</div></li>
    </ul>
    <!-- Background-Grid -->
    
    <!-- End Background Grid -->
    
    @foreach($total as $i => $familias)
    <a href="{{Route('estadisticas.barras',$familias->id_familia)}}">
    <div class="bar two" style="height: {{$familias->suma/$final*100}}%; left: {{$i*10}}%;">{{$familias->suma}}</div>$familias</a>
    {{-- <div style="height: 0px; left: {{$i*10}}%;">
        {{$material->stock}}
    </div> --}}
    @endforeach
  </div>

</section>               

@endsection