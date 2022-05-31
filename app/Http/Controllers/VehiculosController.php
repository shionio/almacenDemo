<?php

namespace App\Http\Controllers;
use DB;
use Session;
use app\post;
use Redirect;
use Illuminate\Http\Request;

class VehiculosController extends Controller
{

    public function index(){
        DB::enableQueryLog();
        $vehiculos = DB::table('vehiculos')
                         ->join('marca','vehiculos.id_marca','=','marca.id_marca')
                         ->join('modelos','vehiculos.id_modelo','=','modelos.id_modelo')
                         ->join('acueducto','vehiculos.id_acueducto','=','acueducto.id_acueducto')
                         ->join('gerencia','vehiculos.id_gerencia','=','gerencia.id_gerencia')
                         ->join('status_vehiculo','vehiculos.id_status_vehiculo','=','status_vehiculo.id_status_vehiculo')
                        ->get();

       return view('vehiculos.listaVehiculos',['vehiculos' => $vehiculos]);
    }

    public function newVehiculo(){
        $marcas = DB::table('marca')->get();
        $acueductos = DB::table('acueducto')->orderBy('nom_acueducto')->get();
        $estatus = DB::table('status')->get();
        $gerencias = DB::table('gerencia')->get();
        $estatusVehiculo = DB::table('status_vehiculo')->get();

        return view('vehiculos.newVehiculo',
                [
                    'marcas'        => $marcas,
                    'acueductos'    => $acueductos,
                    'estatus'       => $estatus,
                    'gerencias'     => $gerencias,
                    'estatusVehi'   => $estatusVehiculo
                ]
        );
    }

    public function create(){

    }

    public function llenarModelo(){
        $idMarca = $_POST['id_marca'];
        $modelos = DB::table('modelos')->where('id_marca',$idMarca)->orderBy('modelo')->get();

        return json_encode($modelos);
    }

    public function save(){
        $msg = "";

        $vehiculo = array(
            'placa_vehiculo'        => $_POST['placa'],
            'id_marca'              => $_POST['marca'],
            'id_modelo'             => $_POST['modelo'],
            'id_status_vehiculo'    => $_POST['estatusVehiculo'],
            'id_acueducto'          => $_POST['acueducto'],
            'id_gerencia'           => $_POST['gerencia'],
            'serial_carroceria'     => $_POST['serialCarroceria'],
            'anio_vehiculo'         => $_POST['anio'],
            'color'                 => $_POST['color'],
            'kilometraje'           => $_POST['kilometraje']
         );

        $vehiculoSave = DB::table('vehiculos')->insert($vehiculo);

        if($vehiculoSave == true){
            Session::flash('msg', 'Vehiculo Almacenado con Exito.!');
            return Redirect('Vehiculos');
        }else{
            Session::flash('msg', 'Fallo al Registrar el Vehiculo. !');
            return Redirect('Vehiculos');
        }
    }

    public function show($idProgrmacion){

    }

    public function buscarVehiculo(){
        DB::enableQueryLog();
        $placa = $_POST['placa'];
        $msg = 'Placa no registrada en el Sistema...';
        $vehiculo = DB::table('vehiculos')
                    ->join('marca','vehiculos.id_marca','=','marca.id_marca')
                    ->join('modelos','vehiculos.id_modelo','=','modelos.id_modelo')
                    ->join('acueducto','vehiculos.id_acueducto','=','acueducto.id_acueducto')
                    ->join('gerencia','vehiculos.id_gerencia','=','gerencia.id_gerencia')
                    ->join('status_vehiculo','vehiculos.id_status_vehiculo','=','status_vehiculo.id_status_vehiculo')
                    ->where('vehiculos.placa_vehiculo','=',$placa )
                    ->get();

        if($vehiculo != ''){
            return json_encode($vehiculo);
        }else{
            return $msg;
        }
    }


    /*
    este espacio es para crear una forma mas optima de crear y editar registros con la misma vista

    public function registro(){
        $marcas = DB::table('marca')->get();
        $acueductos = DB::table('acueducto')->orderBy('nom_acueducto')->get();
        $estatus = DB::table('status')->get();
        $gerencias = DB::table('gerencia')->get();
        $parametrosComunes = array(
            'id_programacion' => '01001010100001',
            'placaVehiculo' => '',
            'fecha' => '',
            'placa' => '',
            'anio' => '',
            'serialCarroceria' => '',
            'taller' => '',
        );

        return view('programacion.formProgramacion',[
                        'parametrosComunes' => $parametrosComunes,
                        'marcas'     => $marcas,
                        'acueductos' => $acueductos,
                        'estatus'    => $estatus,
                        'gerencias'  => $gerencias,
                        //'edtProg'    => $programacion,

                    ]);
    }
    FIN DEL PROCESO para crear una forma mas optima de crear y editar registros con la misma vista
*/
}
