@extends('layouts.dasboard')
@section('title','Total Artículos')
@section('mainPage')

{{-- {{dd($final, $total, $fam)}} --}}

<link href="{{ asset('/css/graficos.css') }}" rel="stylesheet">
         

<section>
<div class="board">
        <div class="titulo_grafica">
            <h3 class="t_grafica">Gráfico de Familias Generales ({{$final}})</h3>
        </div>
        <div class="sub_board">
            <div class="sep_board"></div>
            <div class="cont_board">
                <div class="graf_board">
                  @foreach($total as $familias)
                    <div class="barra1">
                        <div class="sub_barra" style="height: {{$familias->suma/$final*100}}%">
                            <div class="tag_g">{{$familias->suma}}</div>
                  <a href="{{Route('estadisticas.barras',$familias->id_familia)}}">
                            <div class="tag_leyenda">{{$familias->nombre_familia}}</div>
                  </a>
                        </div>
                    </div>
                    @endforeach
                </div>
           </div> 
            <div class="sep_board"></div>
       </div>    
    </div>
</section>

@endsection