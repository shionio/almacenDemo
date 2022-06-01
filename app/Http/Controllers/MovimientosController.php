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

        return json_encode($almacenesRestantes);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $materiales = DB::table('material')
                    ->join('almacen','material.id_almacen','=','almacen.id_almacen')
                    ->join('ubicacion_geografica','ubicacion_geografica.id_ubicacion_geografica','=','almacen.id_ubicacion_geografica')
                    ->join('estados','ubicacion_geografica.id_estado','=','estados.id_estado')
                    ->join('municipios','ubicacion_geografica.id_municipio','=','municipios.id_municipio')
                    ->join('parroquias','ubicacion_geografica.id_parroquia','=','parroquias.id_parroquia')
                    ->select('material.id_material','material.nombre_material','almacen.nombre_almacen','estados.estado','municipios.municipio','parroquias.parroquia','ubicacion_geografica.direccion','material.stock')
                    ->get();
        //dd($materiales);
        return view('solicitudes.listaSolicitud',['materiales' => $materiales]);
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
        //
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
