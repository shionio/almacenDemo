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

    public function buscarAlmaDesti(){
        $id_almacen = $_POST['idAlmacen'];
        $almacenesRestantes = DB::table('almacen')->where('id_almacen','<>',$id_almacen)->get();

        $materialesAlmacen = DB::table('material')->where('id_almacen',$id_almacen)->get();

        $consultas = array(
            'almacenesRestantes' => $almacenesRestantes,
            'materialesAlmacen'  => $materialesAlmacen
        );

        return json_encode($consultas);
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
        ->join('estatus_solicitudes','solicitudes.estatus','=','estatus_solicitudes.id_estatus_solicitud')
        ->select('id_solicitud','fecha_solicitud','usuarios.usuario','id_almacen_origen','id_almacen_destino','cantidad','descripcion_material','unidad_medida','ubicacion','estatus','observaciones','id_usuario','origen.nombre_almacen as almaor','destino.nombre_almacen as almades','estatus_solicitudes.estatus_solicitud')->get()->all();

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


        $materiales = DB::table('material')->select('id_material','nombre_material','stock')->get();
        return view('solicitudes.formSolicitud',['almacenes'=>$almacenes, 'materiales' => $materiales]);


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
            'descripcion_material'  => $_POST['material'],
            'estatus'               => 1 ,
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

            $stock = $_POST['stock'];
            $cantidad = $_POST['cantidadSolicitada'];
            $nuevoStock = intval($stock - $cantidad);

            $insertStock = array(
                'stock' => $nuevoStock
            );

            $actualizarStock = DB::table('material')->where('id_material',$_POST['material'])->update($insertStock);

        }

        return redirect()->route('listaMovimientos');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        DB::enableQueryLog();
        $materiales = DB::table('material')->get();
        $almacenes = DB::table('almacen')->get();
        $estatus_solicitudes = DB::table('estatus_solicitudes')->get();

        $solicitud = DB::table('solicitudes')
                    ->join('material','solicitudes.descripcion_material','=','material.id_material')
                    ->join('almacen AS almacen_origen','almacen_origen.id_almacen','=','solicitudes.id_almacen_origen')
                    ->join('almacen AS almacen_destino','almacen_destino.id_almacen','=','solicitudes.id_almacen_origen')
                    ->where('id_solicitud',$id)
                    ->select('solicitudes.fecha_solicitud','solicitudes.id_almacen_origen','solicitudes.id_almacen_destino','solicitudes.estatus','material.id_material','material.stock','solicitudes.cantidad','solicitudes.observaciones','solicitudes.id_solicitud')
                    ->get()->first();

        return view('solicitudes.formEditSolicitud',
                            [
                                'solicitud'  => $solicitud,
                                'almacenes'  => $almacenes,
                                'materiales' => $materiales,
                                'estatusSolicitudes' => $estatus_solicitudes,
                            ]
        );
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
    public function update(){
//dd($_POST);
        $estatus = $_POST['estatusSolicitud'];
        $id_solicitud= $_POST['idSolicitud'];

        $actualizar = array(
                                'estatus'               => $estatus,
                                'fecha_solicitud'       => $_POST['fecha'],
                                'id_almacen_origen'     => $_POST['almacenOrigen'],
                                'id_almacen_destino'    => $_POST['almacenDestino'],
                                'cantidad'              => $_POST['cantidadSolicitada'],
                                'descripcion_material'  => $_POST['material'],
                                'observaciones'         => $_POST['observacionesSolicitud'],
                            );

        $actSolicitud = DB::table('solicitudes')->where('id_solicitud',$id_solicitud)->update($actualizar);
        if ($actSolicitud == 1){
            $logSolicitudes = array(
                'usuario'           => session('id_usuario'),
                'almacen_origen'    => $_POST['almacenOrigen'],
                'almacen_destino'   => $_POST['almacenDestino'], 
                'cantidad'          => $_POST['cantidadSolicitada'],
                'observaciones'     => $_POST['observacionesSolicitud'],
                'estatus'           => $estatus,
                'id_solicitud'      => $id_solicitud,
            );

            $insertLogSolicitud = DB::table('log_solicitudes')->insert($logSolicitudes);
        }
        if($actSolicitud ==1 && $insertLogSolicitud == true){
            return redirect()->route('listaMovimientos');
        }
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

    public function aprobar($id){
        $estatus_solicitudes = DB::table('estatus_solicitudes')->get();
        $almacenes = DB::table('almacen')->get();
        $materiales = DB::table('material')->get();
        $aprobarSol = $solicitud = DB::table('solicitudes')
                    ->join('material','solicitudes.descripcion_material','=','material.id_material')
                    ->join('almacen AS almacen_origen','almacen_origen.id_almacen','=','solicitudes.id_almacen_origen')
                    ->join('almacen AS almacen_destino','almacen_destino.id_almacen','=','solicitudes.id_almacen_origen')
                    ->where('id_solicitud',$id)
                    ->select('solicitudes.fecha_solicitud','solicitudes.id_almacen_origen','solicitudes.id_almacen_destino','solicitudes.estatus','material.id_material','material.stock','solicitudes.cantidad','solicitudes.observaciones','solicitudes.id_solicitud')
                    ->get()->first();

        return view('solicitudes.formAprobarSolicitud',['solicitud' => $aprobarSol, 'estatusSolicitudes' => $estatus_solicitudes, 'almacenes'  => $almacenes,'materiales' => $materiales,]);
    }

    public function recibir($id){
        $estatus_solicitudes = DB::table('estatus_solicitudes')->get();
        $almacenes = DB::table('almacen')->get();
        $materiales = DB::table('material')->get();
        $aprobarSol = $solicitud = DB::table('solicitudes')
                    ->join('material','solicitudes.descripcion_material','=','material.id_material')
                    ->join('almacen AS almacen_origen','almacen_origen.id_almacen','=','solicitudes.id_almacen_origen')
                    ->join('almacen AS almacen_destino','almacen_destino.id_almacen','=','solicitudes.id_almacen_origen')
                    ->where('id_solicitud',$id)
                    ->select('solicitudes.fecha_solicitud','solicitudes.id_almacen_origen','solicitudes.id_almacen_destino','solicitudes.estatus','material.id_material','material.stock','solicitudes.cantidad','solicitudes.observaciones','solicitudes.id_solicitud')
                    ->get()->first();

        return view('solicitudes.formRecibeSolicitud',['solicitud' => $aprobarSol, 'estatusSolicitudes' => $estatus_solicitudes, 'almacenes'  => $almacenes,'materiales' => $materiales,]);
    }

    public function recibe(){
        DB::enableQueryLog();
        //dd($_POST);
        $cantSolicitada = intval($_POST['cantidadSolicitada']);
        $stock = DB::table('material')
                    ->where(['id_material' => $_POST['material'],'id_almacen' => $_POST['almacenDestino']])
                    ->select('stock')
                    ->get()->first();

        $stockMaterial =$stock->stock;
        
        $stockAingresar = intval($cantSolicitada+$stockMaterial);

        $ingresarStock = DB::table('material')
                            ->where( ['id_material' => $_POST['material'],'id_almacen' => $_POST['almacenDestino']] )
                            ->update(['stock' => $stockAingresar]);

        $actalizarEstatus = DB::table('solicitudes')->where('id_solicitud',$_POST['idSolicitud'])->update(['estatus' => $_POST['estatusSolicitud']]);

        if($ingresarStock == 1){
            $logSolicitudes = array(
                'usuario'           => session('id_usuario'),
                'almacen_origen'    => $_POST['almacenOrigen'],
                'almacen_destino'   => $_POST['almacenDestino'], 
                'cantidad'          => $_POST['cantidadSolicitada'],
                'observaciones'     => $_POST['observacionesSolicitud'],
                'estatus'           => $_POST['estatusSolicitud'],
                'id_solicitud'      => $_POST['idSolicitud'],
            );

            $insertLogSolicitud = DB::table('log_solicitudes')->insert($logSolicitudes);
        }

        //dd($insertLogSolicitud);

        if ( $ingresarStock == 1 && $insertLogSolicitud == true){
            return redirect()->route('listaMovimientos');
        }


    }
}
