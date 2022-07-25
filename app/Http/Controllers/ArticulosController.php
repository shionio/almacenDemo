<?php

namespace App\Http\Controllers;


use DB;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class articulosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){


        $materiales = DB::table('materiales_almacen')
        ->join('materiales','materiales.id_material','=','materiales_almacen.id_material')
        ->join('condicion_materiales','condicion_materiales.id_condicion_material','=','materiales_almacen.id_condicion_material')
        ->join('status_material','status_material.id_estatus_material','=','materiales_almacen.id_estatus_material')
        ->join('almacenes','almacenes.id_almacen','=','materiales_almacen.id_almacen')
        ->join('familias','familias.id_familia','=','materiales.id_familia')
        ->select('materiales_almacen.id_estatus_material',
            'materiales_almacen.id_condicion_material',
            'materiales_almacen.id_material',
            'materiales.descripcion_propuesta',
            'materiales.codigo',
            'materiales.unidad_medida',
            'condicion_materiales.descrip_condicion_material',
            'status_material.desc_estatus_material',
            'materiales_almacen.id_almacen',
            'almacenes.nombre_almacen',
            'almacenes.centro',
            'familias.id_familia',
            'familias.nombre_familia',
            DB::raw("sum(materiales_almacen.stock) as suma"))
        ->groupBy('materiales_almacen.id_material',
            'materiales.descripcion_propuesta',
            'materiales_almacen.id_estatus_material',
            'materiales_almacen.id_condicion_material',
            'condicion_materiales.descrip_condicion_material',
            'status_material.desc_estatus_material',
            'materiales_almacen.id_almacen',
            'almacenes.nombre_almacen',
            'almacenes.centro',
            'materiales.codigo',
            'materiales.unidad_medida',
            'familias.id_familia',
            'familias.nombre_familia',
        )
        ->orderBy('materiales_almacen.id_material')
        ->simplePaginate(15);

        // dd($materiales);
        
        //dd($articulos);
        return view('articulos.listaArticulos',['materiales' => $materiales]);
    }

    public function showArt(){

        $material = DB::table('material')->select('*')->get()->all();
        
        return json_encode($material);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $familia = DB::table('familias')
        ->get();

        return view('articulos.formArticulos',['fam'=>$familia]);

        // $estatusMateriales  = DB::table('status_material')->get();
        // $condicionMaterial  = DB::table('condicion_materiales')->get();
        // $familias           = DB::table('familias')->get();
        // $tipoMovimientos    = DB::table('tipo_ingreso')->get();
        // $materiales         = DB::table('materiales')->get(); 
        
        // $almacenes          = DB::table('almacenes')
        // ->join('usuarios','usuarios.id_almacen','=','almacenes.id_almacen')
        // ->where('usuarios.id_usuario',session('id_usuario'))
        // ->get();
        
        // return view('articulos.formArticulos',
        //     [
        //        'materiales'           => $materiales,
        //        'almacenes'            => $almacenes,
        //        'estatusMateriales'    => $estatusMateriales,
        //        'condicionMateriales'  => $condicionMaterial,
        //        'familias'             => $familias,
        //        'tipoMovimientos'      => $tipoMovimientos,
        //    ]);
    }

    public function nuevoMaterial(Request $request)
    {
        // dd($_POST, $request);

        // if($request->hasFile('archivo')){
        //     $file = $request->file('imagen');
        //     $nombre =  time()."_".$file->getClientOriginalName();
        //     $destino = '/images/materiales';
        //     $filename = time() . '-' . $request->codigo;
        //     $guardar = $request->file('archivo')->move($destino, $filename);

        //     $mat->imagen_material = $filename;

        // };

        $mat = array(
            'codigo' => $_POST['codigo'],
            'descripcion_propuesta' => $_POST['nombreMaterial'],
            'unidad_medida' => $_POST['medida'],
            'id_familia' => $_POST['familia'],
        );


        // script para subir la imagen
// dd($request->codigo);
        // $mat->codigo = $_POST['codigo'];
        // $mat->descripcion_propuesta = $request->nombreMaterial;
        // $mat->unidad_medida = $request->medida;
        // $mat->id_familia = $request->familia;

        // dd($mat);

        $save = DB::table('materiales')
        ->insert($mat);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        // dd($_POST);
        // if($request->hasFile('img_articulo') ){
        //     $imgArticulo = $request->file('img_articulo');
        //     $urlImagen = 'img/imgArticulos/';
        //     $imgName = time() . '-' . $imgArticulo->getClientOriginalName();

        //     //$guardado = $request->file('img_articulo')->move($urlImagen,$imgName);

        //     $urlImagenBaseDeDatos =$urlImagen.$imgName;
        // }

        //dd($urlImagenBaseDeDatos);
        $cod =date("ymd").random_int(0000, 9999);

        // dd($cod);

        $id_almacen = $_POST['idAlmacen'];
        $id_material = $_POST['idMaterial'];

        $almacenMaterialExiste =    DB::table('materiales_almacen')
        ->where(['id_almacen' => $id_almacen, 'id_material' => $id_material])
        ->get()->first();

        //dd($almacenMaterialExiste);

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

                echo '<script>alert (" Entrada de Material Registrado Exitosamente con el código '.$cod.'");window.location.href="/movimientos/entradaMaterial" </script>';
            }else{

                echo '<script> alert("Error al  Registrar el Articulo."); window.location.href="/Articulo/Nuevo" </script>';
            }
        }else{

            $movimientoMaterial = array(
                'id_almacen'            => $_POST['idAlmacen'],
                'id_material'           => $_POST['idMaterial'],
                'id_familia'            => $_POST['familia'],
                'stock'                 => $_POST['stock'],
                'fecha_ingreso'         => $_POST['fecha'],
                'id_tipo_ingreso'       => $_POST['tipoIngresos'],
                'id_estatus_material'   => $_POST['estatusMaterial'],
                'id_condicion_material' => $_POST['condicionMaterial'],
                'observaciones'         => $_POST['observaciones'],
                'activo'                => true,
            );

            $insertArticulo = DB::table('materiales_almacen')->insert($movimientoMaterial);
            //dd($insertArticulo);
        }

        if ($insertArticulo == true){
            $lastId= DB::table('materiales_almacen')->latest('id_materiales_almacenes')->first();


            $inserLog = DB::table('logs')
            ->insert([
                'id_usuario' => session('id_usuario'),
                'fecha_accion' => now(),
                'accion' => 'Ingreso de un nuevo movimiento con el Id= '.$lastId->id_materiales_almacenes,
            ]);
            echo '<script>alert (" Entrada de Material Registrado Exitosamente con el código '.$cod.'");window.location.href="/movimientos/entradaMaterial" </script>';
        }else{

            echo '<script> alert("Error al  Registrar el Articulo."); window.location.href="/Articulo/Nuevo" </script>';
        }
    }

}
