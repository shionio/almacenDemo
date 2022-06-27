<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Session;

class ProgramacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $programaciones =   DB::table('programacion')
                            ->join('vehiculos','vehiculos.placa_vehiculo','=','programacion.placa_vehiculo')
                            ->join('marca','marca.id_marca','=','vehiculos.id_marca')
                            ->join('modelos','modelos.id_modelo','=','vehiculos.id_modelo')
                            ->join('acueducto','acueducto.id_acueducto','=','vehiculos.id_acueducto')
                            ->join('status','status.id_status','=','programacion.id_status')
                            ->get();
        return view('programacion.listaProgramacion',['programaciones' => $programaciones]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $marcas = DB::table('marca')->get();
        $acueductos = DB::table('acueducto')->orderBy('nom_acueducto')->get();
        $estatus = DB::table('status')->get();
        $gerencias = DB::table('gerencia')->get();
        $estatusVehiculo = DB::table('status_vehiculo')->get();

        return view('programacion.formProgramacion',
                        [
                            'marcas'        => $marcas,
                            'acueductos'    => $acueductos,
                            'estatus'       => $estatus,
                            'gerencias'     => $gerencias,
                            'estatusVehi'   => $estatusVehiculo
                        ]
                    );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $programacion  = array(
            'fecha_programacion' => $_POST['fecha'],
            'id_status' => $_POST['estatusProgramacion'],
            'observaciones_program' => $_POST['observaciones'],
            'placa_vehiculo' => $_POST['placa'],
            'taller' => $_POST['taller'],
        );
        $programSave = DB::table('programacion')->insert($programacion);

        if( $programSave == true){
            Session::flash('msg', 'Programacion Almacenada con Exito.!');
            return redirect('programacion');
        }else{
            Session::flash('msg', 'Error al Almacenar la Programacion.!');
            return redirect('programacion');
        }



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($idProgrmacion)
    {
        $marcas = DB::table('marca')->get();
        $acueductos = DB::table('acueducto')->orderBy('nom_acueducto')->get();
        $estatus = DB::table('status')->get();
        $gerencias = DB::table('gerencia')->get();

        $editarProgramacion = DB::table('vehiculos')
                        ->join('programacion','vehiculos.placa_vehiculo','=','programacion.placa_vehiculo')
                        ->join('marca','vehiculos.id_marca','=','marca.id_marca')
                        ->join('modelos','vehiculos.id_modelo','=','modelos.id_modelo')
                        ->join('acueducto','vehiculos.id_acueducto','=','acueducto.id_acueducto')
                        ->join('gerencia','vehiculos.id_gerencia','=','gerencia.id_gerencia')
                        ->join('status','vehiculos.id_status','=','status.id_status')
                        ->where('programacion.id_programacion','=',$idProgrmacion)
                        // ->join('status','programacion.id_status','=','status.id_status')
                        ->select('vehiculos.placa_vehiculo',
                            'vehiculos.anio_vehiculo',
                            'vehiculos.serial_carroceria',
                            'vehiculos.color',
                            'vehiculos.kilometraje',
                            'vehiculos.vehiculo_en_taller',
                            'marca.marca',
                            'modelos.modelo',
                            'modelos.modelo',
                            'acueducto.nom_acueducto',
                            'gerencia.gerencia',
                            'status.status AS estatusVehiculo',
                            'status.id_status AS programacionEstatus')
                        ->get();
        //dd($editarProgramacion);

        return view('programacion.formEditProgramacion',
            [
                'marcas'     => $marcas,
                'acueductos' => $acueductos,
                'estatus'    => $estatus,
                'gerencias'  => $gerencias,
                'edtProg'    => $editarProgramacion,
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
