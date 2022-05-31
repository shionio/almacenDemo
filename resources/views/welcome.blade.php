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
	{{-- <img src="{{asset('img/tacoma2.png')}}" alt=""> --}}
@endsection
