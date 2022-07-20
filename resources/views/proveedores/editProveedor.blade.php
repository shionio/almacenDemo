@extends('layouts.dasboard')
@section('title','Nueva Proveedor')
@section('mainPage')

<div class="container">
    <div class="card-body bg-white">
      <div class="row">
        <div class="col-12">
          <div class="card card-danger">
            <div class="card-header">
              <h3 class="card-title">Nuevo Proveedor</h3>
            </div>
              {{-- {{ Form::open(['route' => ['actualizar.proveedor',$pro->id_proveedor], 'method' => 'POST']),(['role' => 'form']) }} --}}
              <form action="{{Route('actualizar.proveedor')}}" method="POST">
                @csrf
                <input type="hidden" name="id_proveedor" id="id_proveedor" value="{{$pro->id_proveedor}}">
                  <div class="card-body row">
                    <div class="col-sm-2 dis">
                      <div class="form-group">
                        <label>RIF</label>
                          <input class="form-control" type="text" name="rif_p" id="rif_p" value="{{$pro->rif}}" required>
                      </div>
                    </div>
                     <div class="col-sm-6 dis">
                      <div class="form-group">
                        <label>Nombre de Proveedor</label>
                          <input type="text" class="form-control" name="nombre_p" id="nombre_p" value="{{$pro->nombre_proveedor}}" required>
                      </div>
                    </div>

                          <div class="col-sm-4 dis">
                              <!-- select -->
                              <div class="form-group">
                                <label>Descripcion</label>
                                <input class="form-control" type="text" id="descripcion_p" name="descripcion_p" value="{{$pro->descripcion_proveedor}}" required>
                              </div>
                          </div>
                          <div class="col-sm-12 dis">
                              <!-- select -->
                              <div class="form-group">
                                <label>Ubicacion</label>
                                <input class="form-control" type="text" id="ubicacion_p" name="ubicacion_p" value="{{$pro->ubicacion_proveedor}}" required>
                              </div>
                          </div>
                          {{-- <div class="form-group col-4 dis">
                          <label for="exampleInputEmail1">Fecha de Ingreso</label>
                            <input type="text" class="form-control" id="fecha" name="fecha_en" value="{{$pro->_proveedor}}" readonly>
                        </div> --}}
                          <div class="form-group col-4 dis">
                            <label for="exampleInputPassword1">Correo</label>
                            <input type="text" class="form-control" id="correo" name="correo" value="{{$pro->correo_proveedor}}" required>
                          </div>

                          <div class="form-group col-4 dis">
                              <label>Telefonos</label>
                            <input type="text" class="form-control" id="telefonos" name="telefonos" value="{{$pro->telefono_proveedor}}" required>
                          </div>
                      </div>
                    	<div class="card-footer">
                      <div class="row">
                      	<div class="col">
                          <button type="submit" class="btn btn-primary">Actualizar</button>
                        </div>
                        <div class="col" align="right">
                              <a href="{{route('lista.proveedor')}}" class="btn btn-success col-3">Volver</a>
                        </div>
                        </div>
                      </div>
                    </form>
              {{-- {{ Form::close() }} --}}
                  </div>
                </div>
              </div>
          </div>
      </div>
  </div>


@endsection