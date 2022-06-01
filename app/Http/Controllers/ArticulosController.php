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
                              'almacen.descripcion_almacen'
                            )->get();
        //dd($articulos);
        return view('articulos.listaArticulos',['articulos' => $articulos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $proveedores = DB::table('proveedores')->get();
        $almacenes = DB::table('almacen')->get();
        $estatusMateriales = DB::table('status_material')->get();
        $condicionMaterial = DB::table('condicion_materiales')->get();
        $categorias = DB::table('categorias')->get();
        $tipoIngreso = DB::table('tipo_ingreso')->get();
        return view('articulos.formArticulos',
                    ['proveedores'          => $proveedores,
                     'almacenes'            => $almacenes,
                     'estatusMateriales'    => $estatusMateriales,
                     'condicionMateriales'  => $condicionMaterial,
                     'categorias'           => $categorias,
                     'tipoIngreso'         => $tipoIngreso,
                     ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $articulo = array(
            'activo'                => true,
            'nombre_material'       => $_POST['nombreArticulo'],
            'stock'                 => $_POST['stock'],
            'nota_entrega'          => $_POST['notaEntrega'],
            'orden_compra'          => $_POST['ordenCompra'],
            'num_factura'           => $_POST['nFactura'],
            'packlist'              => $_POST['packlist'],
            'unidad_medida'         => $_POST['unidadMedida'],
            'direccion_entrega'     => $_POST['direccionEntrega'],
            'descripcion_material'  => $_POST['descripcionArticulo'],
            'observaciones'         => $_POST['observaciones'],
            'id_categoria'          => $_POST['categoria'],
            'id_proveedor'          => $_POST['proveedor'],
            'id_almacen'            => $_POST['almacen'],
            'id_estatus_material'   => $_POST['estatusMaterial'],
            'id_condicion_material' => $_POST['condicionMaterial'],
            'id_ingreso_material'   => $_POST['ingresoMaterial'],
        );

        $insertArticulo = DB::table('material')->insert($articulo);

        if ($insertArticulo == true){
            $lastId= DB::table('material')->latest('id_material')->first();

            $inserLog = DB::table('logs')
                        ->insert([
                            'id_usuario' => session('id_usuario'),
                            'fecha_accion' => now(),
                            'accion' => 'Ingreso de un nuevo Articulo= '.$_POST['nombreArticulo'].'/id '.$lastId->id_material,
                        ]);
            echo '<script> alert("Articulo Registrado Exitosamente"); window.location.href="/Articulos" </script>';

        }else{

            echo '<script> alert("Articulo Registrado Exitosamente"); window.location.href="/Articulo/Nuevo" </script>';
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
