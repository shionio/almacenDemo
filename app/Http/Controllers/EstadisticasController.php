<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class EstadisticasController extends Controller
{
    public function estArticulos()
    {
        // dd($_REQUEST);
        

        // dd($totalArticulos);

        $sum = DB::table('materiales_almacen')
        ->join('familias','familias.id_familia','=','materiales_almacen.id_familia')
        ->select('materiales_almacen.id_familia','familias.nombre_familia', DB::raw("sum(stock) as suma"))
        ->groupBy('materiales_almacen.id_familia','familias.nombre_familia','familias.id_familia')
        ->orderBy('familias.id_familia')
        ->get();

        $familia = DB::table('familias')

        ->select('id_familia','nombre_familia')
        ->get();

        $final = DB::table('materiales_almacen')
        ->sum('stock');



        // dd($final);

        // $suma = array ('todo'=>$sum);


        // dd($totalArticulos, $suma);
        

        return view('estadisticas.estadisticasArticulos',['fam'=>$familia,'total'=>$sum,'final'=>$final]);
    }

    public function estBarras($id_familia)
    {
        // dd($id_familia);

        // DB::enableQueryLog();
        $materiales = DB::table('materiales_almacen')
        ->join('materiales','materiales.id_material','=','materiales_almacen.id_material')
        ->where('materiales_almacen.id_familia',$id_familia)
        ->select('materiales_almacen.id_material','materiales.descripcion_propuesta', DB::raw("sum(materiales_almacen.stock) as suma"))
        ->groupBy('materiales_almacen.id_material','materiales.descripcion_propuesta')
        ->get();
        // $q = DB::getQueryLog();
        $final = DB::table('materiales_almacen')
        ->where('id_familia',$id_familia)
        ->sum('stock');
        // dd($materiales);

        $familia = DB::table('familias')
        ->where('id_familia',$id_familia)
        ->select('nombre_familia')
        ->get()->first();

        // dd($familia);

        // dd($almacenes);
        return view('estadisticas.barras',['mate'=>$materiales,'fam'=>$familia,'total'=>$final]);
    }
    public function estBarras1($id_material)
    {
        // dd($id_familia);

        // DB::enableQueryLog();
        // $materiales = DB::table('materiales_almacen')
        // ->join('materiales','materiales.id_material','=','materiales_almacen.id_material')
        // ->where('materiales_almacen.id_familia',$id_material)
        // ->select('materiales_almacen.id_material','materiales.descripcion_propuesta', DB::raw("sum(materiales_almacen.stock) as suma"))
        // ->groupBy('materiales_almacen.id_material','materiales.descripcion_propuesta')
        // ->get();


        $material = DB::table('materiales_almacen')
        ->join('almacenes','almacenes.id_almacen','=','materiales_almacen.id_almacen')
        ->join('materiales','materiales.id_material','=','materiales_almacen.id_material')
        ->where('materiales_almacen.id_material',$id_material)
        ->select('materiales_almacen.id_material','almacenes.siglas_almacen','almacenes.id_almacen','materiales.descripcion_propuesta','almacenes.nombre_almacen',DB::raw("sum(stock) as suma"))
        ->groupBy('materiales_almacen.id_almacen','materiales_almacen.id_material','almacenes.siglas_almacen','almacenes.nombre_almacen','materiales.descripcion_propuesta','almacenes.id_almacen')
        ->get();

        // dd($material);


        // $q = DB::getQueryLog();
        $final = DB::table('materiales_almacen')
        ->where('id_material',$id_material)
        ->sum('stock');
        // dd($materiales);

        // $familia = DB::table('familias')
        // ->where('id_familia',$id_familia)
        // ->select('nombre_familia')
        // ->get()->first();

        // dd($familia);

        // dd($almacenes);
        return view('estadisticas.barras1',['total'=>$final,'material'=>$material]);
    }

    public function BuscarMat()
    {

        $consulta = DB::table('familias')
        ->get();

        return view('estadisticas.buscar',['fam'=>$consulta]);
    }

    public function TomarMat()
    {
        dd($_POST);
    }

}
