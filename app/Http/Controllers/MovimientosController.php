<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class MovimientosController extends Controller
{

    public function traerStock(){
        $id_material = $_POST['id_material'];
        $stock = DB::table('material')->where('id_material',$id_material)->select('stock')->get()->first();
        return json_encode($stock);
    }
<<<<<<< HEAD

=======
>>>>>>> 531e46e7f81045cc4b686588504e38efdb5db958
    public function buscarAlmaDesti(){
        $id_almacen = $_POST['idAlmacen'];
        $almacenesRestantes = DB::table('almacen')->where('id_almacen','<>',$id_almacen)->get();

        return json_encode($almacenesRestantes);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        
        $sol = DB::table('solicitudes')
        ->join('usuarios','usuarios.id_usuario','=','solicitudes.id_usuario_solicitante')
        ->join('almacen as origen','origen.id_almacen','=','solicitudes.id_almacen_origen')
        ->join('almacen as destino','destino.id_almacen','=','solicitudes.id_almacen_destino')
        ->select('id_solicitud','fecha_solicitud','usuarios.usuario','id_almacen_origen','id_almacen_destino','cantidad','descripcion','unidad_medida','ubicacion','estatus','observaciones','id_usuario','origen.nombre_almacen as almaor','destino.nombre_almacen as almades')->get()->all();

        // dd($sol);

        // $usuario = DB::table('usuarios')
        // ->where('id_usuario','=',$sol->id_usuario_solicitante)
        // ->select('*')->get()->first();

        // dd($lista);
        // $materiales = DB::table('material')
        //             ->join('almacen','material.id_almacen','=','almacen.id_almacen')
        //             ->join('ubicacion_geografica','ubicacion_geografica.id_ubicacion_geografica','=','almacen.id_ubicacion_geografica')
        //             ->join('estados','ubicacion_geografica.id_estado','=','estados.id_estado')
        //             ->join('municipios','ubicacion_geografica.id_municipio','=','municipios.id_municipio')
        //             ->join('parroquias','ubicacion_geografica.id_parroquia','=','parroquias.id_parroquia')
        //             ->select('material.id_material','material.nombre_material','almacen.nombre_almacen','estados.estado','municipios.municipio','parroquias.parroquia','ubicacion_geografica.direccion','material.stock')
        //             ->get();
        //dd($materiales);
        return view('solicitudes.listaSolicitud',['solicitudes' => $sol]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $almacenes = DB::table('almacen')->get();
<<<<<<< HEAD

        $materiales = DB::table('material')->select('id_material','nombre_material','stock')->get();
        return view('solicitudes.formSolicitud',['almacenes'=>$almacenes, 'materiales' => $materiales]);
=======
        $tipos_movimientos = DB::table('tipos_movimientos')->get();

        $materiales = DB::table('material')->select('id_material','nombre_material','stock')->get();
        return view('solicitudes.formSolicitud',[
                                'almacenes'=>$almacenes,
                                'materiales' => $materiales,
                                'tiposMovimientos' => $tipos_movimientos
                            ]);
>>>>>>> 531e46e7f81045cc4b686588504e38efdb5db958

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($_POST);
        $datosSolicitud = array(

            'fecha_solicitud'       => $_POST['fecha'],
            'id_usuario_solicitante'=> session('id_usuario'),
            'id_almacen_origen'     => $_POST['almacenOrigen'],
            'id_almacen_destino'    => $_POST['almacenDestino'],
            'cantidad'              => $_POST['cantidadSolicitada'],
            'descripcion'           => $_POST['material'],
            'estatus'               => 'Activa',
            'observaciones'         => $_POST['observacionesSolicitud']
        );

        $insertSolicitud = DB::table('solicitudes')->insert($datosSolicitud);

        if( $insertSolicitud == true ){
            $inserLog = DB::table('logs')
                        ->insert([
                            'id_usuario' => session('id_usuario'),
                            'fecha_accion' => now(),
                            'accion' => 'Nueva solicitud Generada por el usuario'.session('usuario'),
                        ]);

            $last = DB::table('solicitudes')->latest('id_solicitud')->first();
            $lastId = $last->id_solicitud;

            $histDatosSol = array(
                'fecha_solicitud'       => $_POST['fecha'],
                'id_almacen_origen'     => $_POST['almacenOrigen'],
                'id_almacen_destino'    => $_POST['almacenDestino'],
                'cantidad'              => $_POST['cantidadSolicitada'],
                'material'              => $_POST['material'],
                'id_solicitud'          => $lastId,
            );

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
