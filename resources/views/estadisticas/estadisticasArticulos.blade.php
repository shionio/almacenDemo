@extends('layouts.dasboard')
@section('title','Total Artículos')
@section('mainPage')

{{-- {{dd($final, $total, $fam)}} --}}

<link href="{{ asset('/css/graficos.css') }}" rel="stylesheet">
         

{{-- <section>
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
</section> --}}
<section>
    <div class="card">
        <div class="card-body">
            <div class="row">
                @foreach($total as $familias)
            <div class="col-3" align="center" style="margin-top: 100px;">
                <a href="{{Route('estadisticas.barras',$familias->id_familia)}}">
                <div style="font-size: 30px;">{{$familias->nombre_familia}}</div>
                <i class="fas fa-warehouse fa-4x"></i>
                <div style="font-size: 40px;">{{$familias->suma}}</div>
            </a>
            </div>
            @endforeach
        </div>
        </div>
    </div>
</section>

@endsection