@extends('layouts.dasboard')
@section('tittle','BARRAS')
@section('mainPage')

{{-- {{dd($mate)}} --}}
<link href="{{ asset('/css/barras.css') }}" rel="stylesheet">

<section>
<div class="row">
    <div class="col-12" align="center">
        
    </div>
    <div class="col-12" align="center">
        
                <h3>{{$fam->nombre_familia}}</h3>
    </div>
    <div class="col-sm-6">
            <!-- HTML5 -->
            @foreach($mate as $i => $alm)
            <a href="{{Route('estadisticas.barrasArt',$alm->id_material)}}">
            <p  data-value="{{$alm->suma}}">{{$alm->descripcion_propuesta}}</p>
            <progress max="{{$total}}" value="{{$alm->suma}}" class="barras">
                <div class="progress-bar">
                    <span style="width: {{$alm->suma}}"></span>
                </div>
            </progress></a>
            @endforeach
        </div></div>
</section>


@endsection