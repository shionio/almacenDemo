@extends('layouts.dasboard')
@section('tittle','BARRAS')
@section('mainPage')

{{-- {{dd($mate)}} --}}
<link href="{{ asset('/css/barras.css') }}" rel="stylesheet">

<section>
    <ul>
        <li>
            <h2>{{$material[0]->descripcion_propuesta}}</h2>

            <!-- HTML5 -->
            @foreach($material as $i => $alm)
            <a href="{{Route('estadisticas.barrasArt',$alm->id_material)}}">
            <p  data-value="{{$alm->suma}}">{{$alm->siglas_almacen}} - {{$alm->nombre_almacen}} </p>
            <progress max="{{$total}}" value="{{$alm->suma}}" class="barras">
                <div class="progress-bar">
                    <span style="width: {{$alm->suma}}"></span>
                </div>
            </progress></a>
            @endforeach
        </li>
    </ul>
</section>


@endsection