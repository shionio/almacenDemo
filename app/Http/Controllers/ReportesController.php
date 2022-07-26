<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Redirect;
use DB;
use PDF;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

class ReportesController extends Controller
{
    public function reporteFiltro()
    {
        $almacenes = DB::table('almacenes')
        ->get(); 

        $status = DB::table('status_material')
        ->get();

        $condicion = DB::table('condicion_materiales')
        ->get();

        $materiales = DB::table('materiales')
        ->get();

        $familia = DB::table('familias')
        ->get();

        return view('reportes.reporteF',['alm' => $almacenes,'est' => $status,'con' => $condicion,'mat'=>$materiales,'fam'=>$familia]);
    }

    public function reporteGeneral()
    {
        DB::enableQueryLog();
        // dd($_GET);
        $consulta = DB::table('materiales_almacen')
        ->join('materiales','materiales.id_material','=','materiales_almacen.id_material')
        ->join('familias','familias.id_familia','materiales.id_familia')
        ->join('condicion_materiales','condicion_materiales.id_condicion_material','=','materiales_almacen.id_condicion_material')
        ->join('status_material','status_material.id_estatus_material','=','materiales_almacen.id_estatus_material')
        ->join('almacenes','almacenes.id_almacen','=','materiales_almacen.id_almacen')
        ->where('materiales_almacen.activo',$_GET['estado'])
        ->when($_GET['almacen'], function ($query) {
            $query->where('materiales_almacen.id_almacen', $_GET['almacen']);
            // $query->select('materiales_almacen.id_almacen','almacenes.nombre_almacen',DB::raw("sum(stock) as suma"));
            
        })
        ->when($_GET['material'], function ($query) {
            $query->where('materiales_almacen.id_material', $_GET['material']);
            // $query->addSelect('materiales_almacen.id_material, materiales.descripcion_propuesta',DB::raw("sum(stock) as suma"));
            
        })
        ->when($_GET['estatus'], function ($query) {
            $query->where('materiales_almacen.id_estatus_material', $_GET['estatus']);
        })
        ->when($_GET['condicion'], function ($query) {
            $query->where('materiales_almacen.id_condicion_material', $_GET['condicion']);
        })
        ->when($_GET['familia'], function ($query) {
            $query->where('materiales.id_familia', $_GET['familia']);
        })
        ->select('*',DB::raw("sum(stock)"))
        ->groupBy('materiales_almacen.id_materiales_almacenes',
            'materiales_almacen.id_material',
            'familias.id_familia',
            'condicion_materiales.id_condicion_material',
            'status_material.id_estatus_material',
            'materiales.id_material',
            'almacenes.id_almacen',
        )->get();
        // ->simplePaginate(50);

        $table = ['nombre_almacen', 'siglas_almacen','centro','nombre_familia','sum','descripcion_propuesta','codigo','unidad_medida','desc_estatus_material','descrip_condicion_material','stock'];

        // dd($consulta);
        // $q = DB::getQueryLog();
        // dd($q);
        if($_GET['buscar'] = 1){

            if($consulta != null){
                return view('reportes.listaReporte',['datos'=>$consulta,'table'=>$table]);
            }else{
                return Redirect::back()->withErrors(['msg' => 'No existen registros en la consulta realizada']);
            }
        }elseif($_GET['buscar'] = 2){

            $pdf = \PDF::loadView('reportes.reportePDF',['datos'=>$consulta,'table'=>$table])->setPaper('letter','landscape');
            return $pdf->stream('reportes.reportePDF');

        }
    }

}
