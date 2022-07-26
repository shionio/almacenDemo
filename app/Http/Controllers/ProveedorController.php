<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ProveedorController extends Controller
{
    public function newProveedor()
    {
        //dd($_POST);
        $rif = $_POST['rif_p'];

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

            return json_encode($rif);
            // return Redirect()->route('lista.proveedor');
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
        // dd($id);
        $pro = DB::table('proveedores')
        ->where('id_proveedor','=',$id)
            ->select('*')
            ->get()
            ->first();

            // dd($pro);
        return view('proveedores.editProveedor',['pro'=>$pro]);
    }

    public function actualizarProveedor()
    {
        // dd($_POST);

        $proveedor = array(
            'rif' => $_POST['rif_p'],
            'activo' => true,
            'nombre_proveedor' => $_POST['nombre_p'],
            'telefono_proveedor' => $_POST['telefonos'],
            'correo_proveedor' => $_POST['correo'],
            'descripcion_proveedor' => $_POST['descripcion_p'],
            'ubicacion_proveedor' => $_POST['ubicacion_p'],
        );
        $prov = DB::table('proveedores')
        ->where('id_proveedor','=',$_POST['id_proveedor'])
        ->update($proveedor);

        $inserLog = DB::table('logs')
                        ->insert([
                            'id_usuario' => session('id_usuario'),
                            'fecha_accion' => now(),
                            'accion' => 'Registro de nuevo proveedor ' .$proveedor['rif']
                        ]);

        return redirect()->route('lista.proveedor');

    }

    public function update($id)
    {
        $a = array('activo'=>true);
        $b = array('activo'=>false);

        $alm = DB::table('proveedores')
        ->where('id_proveedor','=',$id)
        ->select('activo','rif')->get()->first();

        if($alm->activo == true){
            $alm1 = DB::table('proveedores')
            ->where('id_proveedor','=',$id)
            ->update($b);

            $inserLog = DB::table('logs')
                            ->insert([
                                'id_usuario' => session('id_usuario'),
                                'fecha_accion' => now(),
                                'accion' => 'Actualizado Estatus del Proveedor ' .$alm->rif
                            ]);

        }elseif($alm->activo == false){
            $alm2 = DB::table('proveedores')
            ->where('id_proveedor','=',$id)
            ->update($a);

            $inserLog = DB::table('logs')
                            ->insert([
                                'id_usuario' => session('id_usuario'),
                                'fecha_accion' => now(),
                                'accion' => 'Actualizado Estatus del Proveedor ' .$alm->rif
                            ]);
        }
        return back();
    }
}
