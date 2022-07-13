@extends('layouts.dasboard')
@section('title','Nueva Proveedor')
@section('mainPage')

<div class="container">
    <div class="card-body bg-white">
      <div class="row">
        <div class="col-12">
          <div class="card card-danger">
            <div class="card-header">
              <h3 class="card-title">Ingresar Proveedor</h3>
            </div>
              {{ Form::open(['route' => 'guardar.proveedor', 'method' => 'POST']),(['role' => 'form']) }}                    
                @csrf
                  <div class="card-body row">
                    <div class="col-sm-2 dis">
                      <div class="form-group">
                        <label>RIF</label>
                          <input class="form-control" type="text" name="rif_p" id="rif_p" onblur="search_visitante()" required>
                      </div>
                    </div>
                     <div class="col-sm-6 dis">
                      <div class="form-group">
                        <label>Nombre de Proveedor</label>
                          <input type="text" class="form-control" name="nombre_p" id="nombre_p" required>
                      </div>
                    </div>

                          <div class="col-sm-4 dis">
                              <!-- select -->
                              <div class="form-group">
                                <label>Descripcion</label>
                                <input class="form-control" type="text" id="descripcion_p" name="descripcion_p" required>
                              </div>
                          </div>
                          <div class="col-sm-12 dis">
                              <!-- select -->
                              <div class="form-group">
                                <label>Ubicacion</label>
                                <input class="form-control" type="text" id="ubicacion_p" name="ubicacion_p" required>
                              </div>
                          </div>
                          <div class="form-group col-4 dis">
                          <label for="exampleInputEmail1">Fecha de Ingreso</label>
                            <input type="text" class="form-control" id="fecha" name="fecha_en" value="{{date('d/m/Y')}}" readonly>
                        </div>
                          <div class="form-group col-4 dis">
                            <label for="exampleInputPassword1">Correo</label>
                            <input type="text" class="form-control" id="correo" name="correo" required>
                          </div>

                          <div class="form-group col-4 dis">
                              <label>Telefonos</label>
                            <input type="text" class="form-control" id="telefonos" name="telefonos" required>
                          </div>
                      </div>
                    	<div class="card-footer">
                      <div class="row">
                      	<div class="col">
                          <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                        <div class="col" align="right">
                              <a href="{{route('lista.proveedor')}}" class="btn btn-success col-3">Volver</a>
                        </div>
                        </div>
                      </div>
              {{ Form::close() }}
                  </div>
                </div>
              </div>
          </div>
      </div>
  </div>


@endsection
