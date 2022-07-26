<div class="card">
  <div class="card-header">
    <div class="row">
      <div class="col-12" align="center">
        <h2>Orden Nº {{$datos->ent_codigo}}</h2>
      </div>
    </div>
  </div>
  <br>
  <br>
  <br>
  <br>

  <table align="center" width="100%">
    <tr>
      <th style="border-bottom: 1px solid" colspan="4"><p align="center">Codigo de Entrada</p></th>
      <th style="border-bottom: 1px solid" colspan="4"><p align="center">Nombre Almacén</p></th>
      <th style="border-bottom: 1px solid" colspan="4"><p align="center">Nombre Material</p></th>
    </tr>
    <tr>
      <td align="center" colspan="4"> {{$datos->ent_codigo}} </td>
      <td align="center" colspan="4"> {{$datos->nombre_almacen}} </td>
      <td align="center" colspan="4"> {{$datos->descripcion_propuesta}} </td>
    </tr>
  </table>
  <table align="center" width="100%">
    <tr>
      <th style="border-bottom: 1px solid" colspan="3"><p align="center">Codigo Material</p></th>
      <th style="border-bottom: 1px solid" colspan="3"><p align="center">Familia</p></th>
      <th style="border-bottom: 1px solid" colspan="3"><p align="center">Stock</p></th>
      <th style="border-bottom: 1px solid" colspan="3"><p align="center">Tipo Movimiento</p></th>
    </tr>
    <td align="center" colspan="3"> {{$datos->codigo}} </td>
    <td align="center" colspan="3"> {{$datos->nombre_familia}} </td>
    <td align="center" colspan="3"> {{$datos->stock}} </td>
    <td align="center" colspan="3"> {{$datos->tipo_movimiento}} </td>
  </table>

  <table style="margin-top: 100px;" align="center">
    <tr>
      <th align="center">REPONSABLE</th>
    </tr>
    <tr>
      <td align="center">{{session('usuario')}}</td>
    </tr>
    <tr>
      <th align="center">Fecha/Hora</th>
    </tr>
    <tr>
      <td align="center">{{date("Y/m/d")}} - {{date("G:i:s")}}</td>
    </tr>
  </table>
</div>