@extends('layouts.dasboard')
@section('title','Nueva Programacion')
@section('mainPage')

  <div class="container">
    <div class="card-body bg-white">
      <div class="row">
        <div class="col-12">
          <div class="card card-danger">
            <div class="card-header">
              <h3 class="card-title">Nuevo Usuario</h3>
            </div>
              {{ Form::open(['route' => 'registroUser', 'method' => 'POST']),(['role' => 'form']) }}                    
                @csrf
                  <div class="card-body row">
                    <div class="col-sm-3 dis">
                      <div class="form-group">
                        <label>Cedula</label>
                          <input class="form-control" type="text" name="cedula" id="cedula" placeholder="1234567" required>
                      </div>
                    </div>
                     <div class="col-sm-3 dis">
                      <div class="form-group">
                        <label>Nombre</label>
                          <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre" required>
                      </div>
                    </div>

                          <div class="col-sm-3 dis">
                              <!-- select -->
                              <div class="form-group">
                                <label>Apellido</label>
                                <input class="form-control" type="text" id="apellido" name="apellido" placeholder="Apellido" required>
                              </div>
                          </div>
                          <div class="col-sm-3 dis">
                              <!-- select -->
                              <div class="form-group">
                                <label>Cargo</label>
                                <input class="form-control" type="text" id="cargo" name="cargo" required>
                              </div>
                          </div>
                          <div class="form-group col-4 dis">
                              <label>Rol de Usuario</label>
                            <select name="rol" id="rol" class="form-control custom-select required" required>
                                @foreach($roles as $rol)
                                  <option value="{{$rol->id_rol}}">{{$rol->nombre_rol}}</option>
                                @endforeach
                            </select>
                          </div>
                          <div class="form-group col-4 dis">
                            <label for="exampleInputPassword1">Usuario</label>
                            <input type="text" class="form-control" id="usuario" name="usuario" required>
                          </div>

                          <div class="form-group col-4 dis">
                              <label>Contraseña</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                          </div>
                        </div>
                    
                    <div class="container" id="datosArticulo" style="display:none;">
                </div>
                      <div class="card-footer">
                        <div class="row">
                          <div class="col">
                          <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                        <div class="col" align="right">
                          <a href="" class="btn btn-success col-3">Volver</a>
                        </div>
                        </div>
                      </div>
                  {{ Form::close() }}
                </div>
              </div>
            </div>
          </div>
        </div>
      <script type="text/javascript">
        // $(document).ready(function () {
        //   console.log('hello world');
        // });
        //     alert('hola')
            $.ajax({
                type: "POST",
                url: "/roles",
                async: false,
                cache: false,
                data: {
                    "_token": "{{ csrf_token() }}",
                    // condicion: "id_status="+input_origen,
                    table: 'rol',
                    campo: '*'
                },
                success: function(response){
                  console.log(response)

                    var response = $.parseJSON(response);
                    input_destino.empty();
                    for (var i = 0; i < response.length; i++) {
                        input_destino.append("<option value='"+response[i].id_rol+"' >"+response[i].nom_rol+"</option>");
                    }
                }
            });
        

        
      </script>     
  
@endsection