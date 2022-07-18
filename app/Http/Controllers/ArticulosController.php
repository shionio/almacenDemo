<?php

namespace App\Http\Controllers;


use DB;
use Illuminate\Http\Request;

class articulosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $articulos = DB::table('material')
                     ->join('almacen','almacen.id_almacen','=','material.id_almacen')
                     ->select('material.id_material',
                              'material.nombre_material',
                              'material.descripcion_material',
                              'material.stock',
                              'material.unidad_medida',
                              'material.img_material',
                              'almacen.descripcion_almacen'
                            )->get();
        //dd($articulos);
        return view('articulos.listaArticulos',['articulos' => $articulos]);
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
    public function create(){

        $estatusMateriales  = DB::table('status_material')->get();
        $condicionMaterial  = DB::table('condicion_materiales')->get();
        $familias           = DB::table('familias')->get();
        $tipoMovimientos    = DB::table('tipo_ingreso')->get();
        $materiales         = DB::table('materiales')->get(); 
        
        $almacenes          = DB::table('almacenes')
                              ->join('usuarios','usuarios.id_almacen','=','almacenes.id_almacen')
                              ->where('usuarios.id_usuario',session('id_usuario'))
                              ->get();
    
        return view('articulos.formArticulos',
                    [
                     'materiales'           => $materiales,
                     'almacenes'            => $almacenes,
                     'estatusMateriales'    => $estatusMateriales,
                     'condicionMateriales'  => $condicionMaterial,
                     'familias'             => $familias,
                     'tipoMovimientos'      => $tipoMovimientos,
                    ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        //dd($_POST);
        // if($request->hasFile('img_articulo') ){
        //     $imgArticulo = $request->file('img_articulo');
        //     $urlImagen = 'img/imgArticulos/';
        //     $imgName = time() . '-' . $imgArticulo->getClientOriginalName();

        //     //$guardado = $request->file('img_articulo')->move($urlImagen,$imgName);

        //     $urlImagenBaseDeDatos =$urlImagen.$imgName;
        // }

        //dd($urlImagenBaseDeDatos);

        

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
            //'stock_inicial'         => $_POST['stockInicial'],
        );
        //dd($movimientoMaterial);


        $insertArticulo = DB::table('materiales_almacen')->insert($movimientoMaterial);
        //dd($insertArticulo);

        if ($insertArticulo == true){
            $lastId= DB::table('materiales_almacen')->latest('id_materiales_almacenes')->first();
            //dd($lastId);

            $inserLog = DB::table('logs')
                        ->insert([
                            'id_usuario' => session('id_usuario'),
                            'fecha_accion' => now(),
                            'accion' => 'Ingreso de un nuevo movimiento con el Id= '.$lastId->id_materiales_almacenes,
                        ]);
            echo '<script> alert("Ingreso de Articulo Registrado Exitosamente"); window.location.href="/Articulo/Nuevo" </script>';

        }else{

            echo '<script> alert("Error al  Registrar el Articulo."); window.location.href="/Articulo/Nuevo" </script>';
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
