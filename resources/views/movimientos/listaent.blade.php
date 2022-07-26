@extends('layouts.dasboard')
@section('title','Nueva entrada de Material')
@section('mainPage')

{{-- {{dd($datos)}} --}}
<div class="card">
  <div class="card-header">
        <div class="row">
          <div class="col-10">
            <h2>Histórico de Movimientos</h2>
          </div>
          <div class="col-2">

          </div>
        </div>

      </div>

  <div class="card-body shadow mb-4 table-responsive bg-white tabla" id="filtroTabla">
    <table class="table">
      <thead class="thead-dark">
        <tr>
          <th><p align="center">Codigo de Entrada</p></th>
          <th><p align="center">Nombre Almacón</p></th>
          <th><p align="center">Nombre Material</p></th>
          <th><p align="center">Codigo Material</p></th>
          <th><p align="center">Familia</p></th>
          {{-- <th><p align="center">Nº Control</p></th> --}}
          <th><p align="center">Stock</p></th>
          <th><p align="center">Tipo Movimiento</p></th>
          @if(session('rol') == 1)
          <th><p align="center">Acciones</p></th>
          @endif
        </tr>
      </thead>
      <tbody>
        @foreach($datos as $proveedor)
          <tr>
            <td align="center"> {{$proveedor->ent_codigo}} </td>
            <td align="center"> {{$proveedor->nombre_almacen}} </td>
            <td align="center"> {{$proveedor->descripcion_propuesta}} </td>
            <td align="center"> {{$proveedor->codigo}} </td>
            <td align="center"> {{$proveedor->nombre_familia}} </td>
            {{-- <td align="center"> {{$proveedor->n_control}} </td> --}}
            <td align="center"> {{$proveedor->stock}} </td>
            <td align="center"> {{$proveedor->tipo_movimiento}} </td>
              <td>
                <abbr title="Descargar PDF">
                  <a href="{{Route('pdf.hist',$proveedor->ent_codigo)}}">
                    <i class="fa-solid fa fa-download fa-2x"></i>
                  </a>
                </abbr>
              </td>
          </tr>
        @endforeach
      </tbody>
      <tfoot class="thead-dark">
        <tr>
          <th><p align="center">Codigo de Entrada</p></th>
          <th><p align="center">Nombre Almacen</p></th>
          <th><p align="center">Nombre Material</p></th>
          <th><p align="center">Codigo Material</p></th>
          <th><p align="center">Familia</p></th>
          {{-- <th><p align="center">Nº Control</p></th> --}}
          <th><p align="center">Stock</p></th>
          <th><p align="center">Tipo Movimiento</p></th>
          <th><p align="center">Acciones</p></th>
        </tr>
      </tfoot>
    </table>
  </div>
</div>


@endsection