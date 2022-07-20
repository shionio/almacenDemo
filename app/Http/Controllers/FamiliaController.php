<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class FamiliaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lastFamilia = DB::table('familias')->latest('id_familia')->get()->first();
        $lastFamilia = $lastFamilia->id_familia+1; //aca obtenemos solo el ultimo id de las familias
        return view('familias.formFamilia',['ultimaFamilia' => $lastFamilia]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $familia = array(
            'id_familia'        => $_POST['id_familia'],
            'nombre_familia'    => strtoupper($_POST['nombre_familia']),
        );

        $guardar_familia = DB::table('familias')->insert($familia);
        //dd($guardar_familia);
        if($guardar_familia == true){
            echo '<script> alert("Familia registrada exitosamente!") window.location.href="inicio" </script>';
        }else{
            echo '<script > alert("Fallo al registrar la familia") window.location.href="inicio" </script>';
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
