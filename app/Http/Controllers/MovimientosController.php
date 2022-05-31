<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class MovimientosController extends Controller
{
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
        //dd('llega');
        return view('solicitudes.formSolicitud');
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
