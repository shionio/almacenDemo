<?php

namespace App\Http\Controllers;

use DB;
use PDF;
use Illuminate\Http\Request;

class MovimientosController extends Controller
{

    public function guardarEntradaMaterial(Request $request){
        // dd($_POST);
        // if($request->hasFile('img_articulo') ){
        //     $imgArticulo = $request->file('img_articulo');
        //     $urlImagen = 'img/imgArticulos/';
        //     $imgName = time() . '-' . $imgArticulo->getClientOriginalName();

        //     //$guardado = $request->file('img_articulo')->move($urlImagen,$imgName);

        //     $urlImagenBaseDeDatos =$urlImagen.$imgName;
        // }

        //dd($urlImagenBaseDeDatos);

        $id_almacen = $_POST['idAlmacen'];
        $id_material = $_POST['idMaterial'];

        $almacenMaterialExiste =    DB::table('materiales_almacen')
                                    ->where(['id_almacen' => $id_almacen, 'id_material' => $id_material])
                                    ->get()->first();

        if($almacenMaterialExiste !=null){
            $stockExiste = $almacenMaterialExiste->stock;
            $nuevoStock = $stockExiste +  $_POST['stock'];

            $updateStock = DB::table('materiales_almacen')
                                    ->where(['id_almacen' => $id_almacen, 'id_material' => $id_material])
                                    ->update(['stock' => $nuevoStock ]);
            if($updateStock != 0){
                $lastId= DB::table('materiales_almacen')->latest('id_materiales_almacenes')->first();
                $inserLog = DB::table('logs')
                            ->insert([
                                'id_usuario' => session('id_usuario'),
                                'fecha_accion' => now(),
                                'accion' => 'Registro de un nuevo movimiento con el Id= '.$lastId->id_materiales_almacenes.', se agrego el stock entrante'
                            ]);
                echo '<script> alert("Ingreso de Articulo Registrado Exitosamente"); window.location.href="/Articulo/Nuevo" </script>';
            }else{

                echo '<script> alert("Error al  Ingresar el Articulo."); window.location.href="/Articulo/Nuevo" </script>';
            }
        }else{

            $movimientoMaterial = array(
                'id_almacen'            => $_POST['idAlmacen'],
                'id_material'           => $_POST['idMaterial'],
                'id_familia'            => $_POST['idFamilia'],
                'stock'                 => $_POST['stock'],
                'fecha_ingreso'         => $_POST['fecha'],
                'id_tipo_ingreso'       => $_POST['tipoIngresos'],
                'id_estatus_material'   => $_POST['estatusMaterial'],
                'id_condicion_material' => $_POST['condicionMaterial'],
                'observaciones'         => $_POST['observaciones'],
                'activo'                => true,
            );

            $insertArticulo = DB::table('materiales_almacen')->insert($movimientoMaterial);

        }

        if ($insertArticulo == true){
            $lastId= DB::table('materiales_almacen')->latest('id_materiales_almacenes')->first();

            $inserLog = DB::table('logs')
                        ->insert([
                            'id_usuario' => session('id_usuario'),
                            'fecha_accion' => now(),
                            'accion' => 'Registro de un nuevo movimiento con el Id= '.$lastId->id_materiales_almacenes,
                        ]);
            echo '<script> alert("Ingreso de Material Registrado Exitosamente"); window.location.href="/Articulo/Nuevo" </script>';

        }else{

            echo '<script> alert("Error al  Registrar el Material."); window.location.href="/Articulo/Nuevo" </script>';
        }
    }


    public function nuevaEntrada(){

        $estatusMateriales  = DB::table('status_material')->get();
        $condicionMaterial  = DB::table('condicion_materiales')->get();
        $familias           = DB::table('familias')->get();
        $tipoMovimientos    = DB::table('tipo_ingreso')->get();
        $materiales         = DB::table('materiales')->get();

        $almacenes          = DB::table('almacenes')
                              //->join('usuarios','usuarios.id_almacen','=','almacenes.id_almacen')
                              //->where('usuarios.id_usuario',session('id_usuario'))
                              ->get();

        return view('movimientos.entradaMaterial',
                    [
                        'materiales'           => $materiales,
                        'almacenes'            => $almacenes,
                        'estatusMateriales'    => $estatusMateriales,
                        'condicionMateriales'  => $condicionMaterial,
                        'familias'             => $familias,
                        'tipoMovimientos'      => $tipoMovimientos,
                    ]);
    }


    public function mostrarSalidaMaterial(){
        $estatusMateriales  = DB::table('status_material')->get();
        $condicionMaterial  = DB::table('condicion_materiales')->get();
        $familias           = DB::table('familias')->get();
        $tipoMovimientos    = DB::table('tipo_salida')->get();
        $materiales         = DB::table('materiales')->get();

        if(session('id_usuario') != 0){
            $almacenes          = DB::table('almacenes')
                                  ->join('usuarios','usuarios.id_almacen','=','almacenes.id_almacen')
                                  ->where('usuarios.id_usuario',session('id_usuario'))
                                  ->get();
        }else{
            $almacenes          = DB::table('almacenes')
                                  ->join('usuarios','usuarios.id_almacen','=','almacenes.id_almacen')
                                  ->get();
        }

         return view('movimientos.salidaMaterial',
                    [
                        'materiales'           => $materiales,
                        'almacenes'            => $almacenes,
                        'estatusMateriales'    => $estatusMateriales,
                        'condicionMateriales'  => $condicionMaterial,
                        'familias'             => $familias,
                        'tipoMovimientos'      => $tipoMovimientos,
                    ]);

    }

    public function guardarSalidaMaterial(){
        // dd($_POST);
        $stockSalida = $_POST['stock']; //monto que va a salir de la base de datos

        $material_almacen = DB::table('materiales_almacen')
                                ->where(['id_material' => $_POST['idMaterial'], 'id_almacen' => $_POST['idAlmacen']])
                                ->get()->first();

        if($material_almacen != null ){

            $stockActual = $material_almacen->stock; // stock del material en almancen

            $stockRestante = $stockActual-$stockSalida;


            $updStock = DB::table('materiales_almacen')->where(['id_material' => $_POST['idMaterial'], 'id_almacen' => $_POST['idAlmacen']])
                        ->update(['stock' => $stockRestante]);

            if($updStock > 0){
                $lastId= DB::table('materiales_almacen')->latest('id_materiales_almacenes')->first();
                $inserLog = DB::table('logs')
                        ->insert([
                            'id_usuario' => session('id_usuario'),
                            'fecha_accion' => now(),
                            'accion' => 'Salida de material con el Id= '.$lastId->id_materiales_almacenes,
                        ]);

                echo '<script> alert("Salida del material realizada Exitosamente"); window.location.href="/movimientos/salidaMaterial"</script>';

            }

        }else{

            echo '<script> alert("No contamos con inventario para el material seleccionado!"); window.location.href="/movimientos/salidaMaterial" </script>';

        }




    }

    public function traerStock(){
        DB::enableQueryLog();
        $id_material = $_POST['id_material'];
        $id_almacen  = $_POST['id_almacen'];
        $stock = DB::table('materiales_almacen')->where(['id_material' => $id_material/*, 'id_almacen'=> $id_almacen*/ ])->select('id_material','stock','id_almacen')->get()->first();
        //dd($stock);
        $q = DB::getQueryLog();
        //dd($q);
        //dd($stock);
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
        ->select('id_solicitud',
                'fecha_solicitud',
                'usuarios.usuario',
                'id_almacen_origen',
                'id_almacen_destino',
                'cantidad',
                'descripcion_material',
                'unidad_medida',
                'ubicacion',
                'estatus',
                'observaciones',
                'id_usuario',
                'origen.nombre_almacen as almaor',
                'destino.nombre_almacen as almades',
                'estatus_solicitudes.estatus_solicitud')
        ->get()->all();

        return view('solicitudes.listaSolicitud',['solicitudes' => $sol]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $almacenes = DB::table('almacenes')->get();

        $almacenUsuario = DB::table('almacenes')
                            ->where('id_almacen',session('id_almacen'))
                            ->select('id_almacen','nombre_almacen')
                            ->get();


        $materiales =   DB::table('materiales_almacen')
                        ->join('materiales','materiales.id_material','=','materiales_almacen.id_material')
                        ->where('id_almacen',session('id_almacen'))
                        ->select('materiales.id_material','materiales.descripcion_propuesta','materiales_almacen.stock')
                        ->get(); //dd($materiales);

        return view('solicitudes.formSolicitud',[
                                                    'almacenes'        => $almacenes,
                                                    'materiales'       => $materiales,
                                                    'almacenUsuario'   => $almacenUsuario,
                                                ]
                    );


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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


    public function entradaPorTraspaso(Request $request){
        //dd($_POST);
        $datosSolicitud = array(
            'fecha_solicitud'           => $_POST['fecha'],
            'id_usuario_solicitante'    => session('id_usuario'),
            'id_almacen_origen'         => $_POST['almacenOrigen'],
            'id_almacen_destino'        => $_POST['idAlmacenDestino'],
            'estatus'                   => 1 ,
            'observaciones'             => $_POST['observacionesSolicitud']
        );

        $insertSolicitud = DB::table('solicitudes')->insert($datosSolicitud);
        $lastId = DB::table('solicitudes')->latest('id_solicitud')->first();
        $lastId = $lastId->id_solicitud;

        if( $insertSolicitud == true ){

            foreach ($_POST['idMaterial'] as $i => $idMat) {
                $materialesSolicitud[$i]['id_material'] = $idMat;
                $materialesSolicitud[$i]['id_solicitud'] = $lastId;
            }

            foreach ($_POST['stock'] as $i => $cant) {
                $materialesSolicitud[$i]['cantidad'] = $cant;
                $materialesSolicitud[$i]['id_solicitud'] = $lastId;
            }

            $insertMaterialesSolicitud = DB::table('materiales_solicitudes')->insert($materialesSolicitud);

            if($insertMaterialesSolicitud == true){
                $inserLog = DB::table('logs')
                        ->insert([
                            'id_usuario' => session('id_usuario'),
                            'fecha_accion' => now(),
                            'accion' => 'Nueva Solicitud creada por el Usuario: '.session('usuario'),
                        ]);
                echo '<script> alert("Solicitud de Material Generada Exitosamente!"); window.location.href="/Solicitudes"</script>';
            }

        }else{
            echo '<script> alert("Fallo al generar la Solicitud de Material"); window.location.href="/entradaPorTraspaso"</script>';
        }

        //return redirect()->route('listaMovimientos');

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
        $materiales = DB::table('materiales')->get();
        $almacenes = DB::table('almacen')->get();
        $estatus_solicitudes = DB::table('estatus_solicitudes')->get();

        $solicitud = DB::table('solicitudes')
                    ->join('material','solicitudes.descripcion_material','=','material.id_material')
                    ->join('almacen AS almacen_origen','almacen_origen.id_almacen','=','solicitudes.id_almacen_origen')
                    ->join('almacen AS almacen_destino','almacen_destino.id_almacen','=','solicitudes.id_almacen_destino')
                    ->where('id_solicitud',$id)
                    ->select('solicitudes.fecha_solicitud',
                            'solicitudes.id_almacen_origen',
                            'solicitudes.id_almacen_destino',
                            'solicitudes.estatus',
                            'material.id_material',
                            'material.stock',
                            'solicitudes.cantidad',
                            'solicitudes.observaciones',
                            'solicitudes.id_solicitud')
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


     public function aprobar($id){
        $estatus_solicitudes = DB::table('estatus_solicitudes')->get();
        $almacenes = DB::table('almacen')->get();
        $materiales = DB::table('material')->get();
        $aprobarSol = $solicitud = DB::table('solicitudes')
                    ->join('material','solicitudes.descripcion_material','=','material.id_material')
                    ->join('almacen AS almacen_origen','almacen_origen.id_almacen','=','solicitudes.id_almacen_origen')
                    ->join('almacen AS almacen_destino','almacen_destino.id_almacen','=','solicitudes.id_almacen_destino')
                    ->where('id_solicitud',$id)
                    ->select('solicitudes.fecha_solicitud',
                            'solicitudes.id_almacen_origen',
                            'solicitudes.id_almacen_destino',
                            'solicitudes.estatus',
                            'material.id_material',
                            'material.nombre_material',
                            'material.stock',
                            'solicitudes.cantidad',
                            'solicitudes.observaciones',
                            'solicitudes.id_solicitud',
                            'almacen_origen.nombre_almacen AS almaOri',
                            'almacen_destino.nombre_almacen AS almaDesti',
                        )
                    ->get()->first();

        return view('solicitudes.formAprobarSolicitud',['solicitud' => $aprobarSol, 'estatusSolicitudes' => $estatus_solicitudes, 'almacenes'  => $almacenes,'materiales' => $materiales,]);
    }

    public function aprobada(){
        //dd($_POST);
        $id_solicitud   = $_POST['idSolicitud'];
        $id_estatus     = $_POST['estatusSolicitud'];
        $observaciones  = $_POST['observacionesSolicitud'];

        $actualizar = DB::table('solicitudes')->where('id_solicitud',$id_solicitud)->update(['estatus' => $id_estatus,'observaciones' => $observaciones ]);

        if ($actualizar == 1){
            echo '<script> alert("Movimiento Realizado Exitosamente"); window.location.href="/Solicitudes" </script>';
        }else{
            echo '<script> alert("Fallo En El Movimiento"); window.location.href="/Solicitudes" </script>';
        }
    }

   

    public function recibir($id){
        $estatus_solicitudes = DB::table('estatus_solicitudes')->get();
        $almacenes  = DB::table('almacen')->get();
        $materiales = DB::table('material')->get();
        $aprobarSol = DB::table('solicitudes')
                    ->join('material','solicitudes.descripcion_material','=','material.id_material')
                    ->join('almacen AS almacen_origen','almacen_origen.id_almacen','=','solicitudes.id_almacen_origen')
                    ->join('almacen AS almacen_destino','almacen_destino.id_almacen','=','solicitudes.id_almacen_destino')
                    ->where('id_solicitud',$id)
                    ->select('solicitudes.fecha_solicitud',
                            'solicitudes.id_almacen_origen',
                            'solicitudes.id_almacen_destino',
                            'solicitudes.estatus',
                            'material.id_material',
                            'material.stock',
                            'material.nombre_material',
                            'solicitudes.cantidad',
                            'solicitudes.observaciones',
                            'solicitudes.id_solicitud',
                            'almacen_origen.nombre_almacen AS almaOri',
                            'almacen_destino.nombre_almacen AS almaDesti',
                            'material.id_material',
                            'almacen_origen.id_almacen AS idAlmaOri',
                            'almacen_destino.id_almacen AS idAlmaDesti',
                        )
                    ->get()->first();

        return view('solicitudes.formRecibeSolicitud',['solicitud'          => $aprobarSol,
                                                       'estatusSolicitudes' => $estatus_solicitudes,
                                                       'almacenes'          => $almacenes,
                                                       'materiales'         => $materiales,
                                                   ]);
    }

    public function recibe(){
        //dd($_POST);
        DB::enableQueryLog();

        $cantSolicitada = intval($_POST['cantidadSolicitada']);
        $stock = DB::table('material')
                    ->where(['id_material' => $_POST['id_material'], 'id_almacen' => $_POST['idAlmacenDestino'] ])
                    ->select('stock')
                    ->get()->first();
        //dd($stock);
        $q = DB::getQueryLog();


        if($stock == null){
            $buscarMaterialAlmacen = DB::table('material')->where('id_material',$_POST['id_material'])->get()->first();

            $nuevoArticulo = array(
                'nombre_material'       => $buscarMaterialAlmacen->nombre_material,
                'descripcion_material'  => $buscarMaterialAlmacen->descripcion_material,
                'unidad_medida'         => $buscarMaterialAlmacen->unidad_medida,
                'activo'                => true,
                'stock'                 => intval($_POST['cantidadSolicitada']),
                'id_estatus_material'   => intval($buscarMaterialAlmacen->id_estatus_material),
                'id_almacen'            => intval($_POST['idAlmacenDestino']),
                'id_categoria'          => $buscarMaterialAlmacen->id_categoria,
                'id_condicion_material' => $buscarMaterialAlmacen->id_condicion_material,
                'id_ingreso_material'   => $buscarMaterialAlmacen->id_ingreso_material,
                'nota_entrega'          => $buscarMaterialAlmacen->nota_entrega,
                'orden_compra'          => $buscarMaterialAlmacen->orden_compra,
                'num_factura'           => $buscarMaterialAlmacen->num_factura,
                'packlist'              => $buscarMaterialAlmacen->packlist,
                'direccion_entrega'     => $buscarMaterialAlmacen->direccion_entrega,
                'observaciones'         => $buscarMaterialAlmacen->observaciones,
                'id_proveedor'          => $buscarMaterialAlmacen->id_proveedor,
                'stock_inicial'         => intval($_POST['cantidadSolicitada']),
            );

            //dd($nuevoArticulo);
                $ingresarNuevoMaterial = DB::table('material')->insert( $nuevoArticulo);

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

        }else{

            $stockMaterial =$stock->stock;

            $stockAingresar = intval($cantSolicitada+$stockMaterial);
            //dd($stockAingresar);

            $ingresarStock = DB::table('material')
                                ->where( ['id_material' => $_POST['id_material'],'id_almacen' => $_POST['idAlmacenDestino']] )
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

        }

        if ( $insertLogSolicitud == true){
            return redirect()->route('listaMovimientos');
        }


    }

    public function solicitudPDF($id_solicitud){
        // dd($id_solicitud);

        $materiales = DB::table('material')->get();
        $almacenes = DB::table('almacen')->get();
        $estatus_solicitudes = DB::table('estatus_solicitudes')->get();

        $solicitud = DB::table('solicitudes')
                    ->join('material','solicitudes.descripcion_material','=','material.id_material')
                    ->join('almacen AS almacen_origen','almacen_origen.id_almacen','=','solicitudes.id_almacen_origen')
                    ->join('almacen AS almacen_destino','almacen_destino.id_almacen','=','solicitudes.id_almacen_destino')
                    ->join('estatus_solicitudes AS status','solicitudes.estatus','=','status.id_estatus_solicitud')
                    ->where('id_solicitud',$id_solicitud)
                    ->select('solicitudes.fecha_solicitud','solicitudes.id_almacen_origen','solicitudes.id_almacen_destino','solicitudes.estatus','material.id_material','material.stock','solicitudes.cantidad','solicitudes.observaciones','solicitudes.id_solicitud','almacen_origen.nombre_almacen as almaor','almacen_destino.nombre_almacen as almade','status.estatus_solicitud','material.nombre_material')
                    ->get()->first();

        $pdf = \PDF::loadView('PDF.solPdf',[
                                'solicitud'  => $solicitud,
                                'almacenes'  => $almacenes,
                                'materiales' => $materiales,
                                'estatusSolicitudes' => $estatus_solicitudes,
                            ])->setPaper('letter','landscape');
        return $pdf->stream('solicitudes.pdf');

    }

    public function entradaMaterial(){

        $tipoEntradaMaterial = DB::table('tipo_entrada_salida')->where('tipo_movimiento',1)->get();
        $almacenes = DB::table('almacen')->get();

        return view('movimientos.entradaMaterial',[ 'entradas' => $tipoEntradaMaterial,
                                                    'almacenes' => $almacenes,
                                                  ]);
    }

    public function guadarEntradaMaterial(){

        foreach($_POST['idMaterial'] as $i => $id_material){
            $stock = $_POST['stock'][$i];
            $id_material = $_POST['idMaterial'][$i];
            $cantidad_entrada = $_POST['cantidadEntrada'][$i];

            $stockTotal = $stock+$cantidad_entrada;

            $ingresarStock = DB::table('material')->where('id_material',$id_material)->update(['stock' => $stockTotal]);

            if($ingresarStock == 1){
                echo '<script> alert("Ingreso Realizado Exitosamente"); window.location.href="/movimientos/entradaPorTraspaso" </script>';
            }else{
                echo '<script> alert("Fallo al ingresar los Materiales"); window.location.href="/movimientos/entradaPorTraspaso" </script>';
            }
        }
    }

    public function salidaMaterial(){
        return view('movimientos.salidaMaterial');
    }

    // public function guardarSalidaMaterial(){

    // }
}
