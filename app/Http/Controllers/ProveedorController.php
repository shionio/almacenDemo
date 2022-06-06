<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ProveedorController extends Controller
{
    public function newProveedor()
    {
        //dd($_POST);

        $proveedor = array(
            'rif' => $_POST['rif_p'],
            'activo' => true,
            'nombre_proveedor' => $_POST['nombre_p'],
            'telefono_proveedor' => $_POST['telefonos'],
            'correo_proveedor' => $_POST['correo'],
            'descripcion_proveedor' => $_POST['descripcion_p'],
            'ubicacion_proveedor' => $_POST['ubicacion_p'],
        );

        // dd($proveedor);
        $p = DB::table('proveedores')->insert($proveedor);
        $inserLog = DB::table('logs')
                        ->insert([
                            'id_usuario' => session('id_usuario'),
                            'fecha_accion' => now(),
                            'accion' => 'Registro de nuevo proveedor ' .$proveedor['rif']
                        ]);

        if($p == true and $inserLog == true){
            return Redirect()->route('lista.proveedor')->with('success', 'Proveedor Registrado con Éxito');
        }else{
            return Redirect()->back()->with('message','Ocurrio un Error al intentar registrar nuevo proveedor');
        }
    }

    public function listProveedor(){

        $pro = DB::table('proveedores')
            ->select('*')
            ->get()
            ->all();

        return view('proveedores.listaProveedor',['lista' => $pro]);
    }

    public function editarPro($id)
    {

    }

    public function update($id)
    {
        $a = array('activo'=>true);
        $b = array('activo'=>false);

        $alm = DB::table('proveedores')
        ->where('id_proveedor','=',$id)
        ->select('activo')->get()->first();

        if($alm->activo == true){
        $alm = DB::table('proveedores')
        ->where('id_proveedor','=',$id)
        ->update($b);
        }elseif($alm->activo == false){
        $alm = DB::table('proveedores')
        ->where('id_proveedor','=',$id)
        ->update($a);
        }
        return back();
    }
}
