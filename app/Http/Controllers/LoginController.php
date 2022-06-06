<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Login;
use DB;

class LoginController extends Controller
{
    public function index(){
        
            return view('welcome');
    }

    public function check_user(Request $r){
        //dd($r);

        $usuario = $r->usuario;
        $clave = $r->clave;

        $session = DB::table('usuarios')->where(['usuario'=>$usuario,'activo'=> true])
        ->select('*')->get()->first();
        //dd($query);
        if (password_verify($r->clave, $session->password)){


            session([
                'id_usuario' => $session->id_usuario,
                'usuario' => $session->usuario,
                'rol' => $session->id_rol,
            ]);

            $inserLog = DB::table('logs')->insert([
                                                    'id_usuario' => $session->id_usuario,
                                                    'fecha_accion' => now(),
                                                    'accion' => 'Inicio de sesion',
                                                ]);
            return redirect('inicio');
        }else{

            return redirect('/')->with('msg','Datos Invalidos');
        }
    }

    public function nuevo()
    {
        $rol = DB::table('roles')
        ->select('*')->get()->all();

        return view('usuarios.registro',['roles'=>$rol]);
    }

    public function registrar()
    {

        $user = array(
            'usuario'=>$_POST['usuario'],
            'nombre'=>$_POST['nombre'],
            'apellido'=>$_POST['apellido'],
            'cargo'=>$_POST['cargo'],
            'id_rol'=>$_POST['rol'],
            'activo'=>true,
            'password'=>bcrypt($_POST['password']),
            'cedula'=>$_POST['cedula'],
        );

        $usuario = DB::table('usuarios')
        ->insert($user);

        if($usuario == true){
            echo'<script type="text/javascript"> alert("Usuario registrado correctamente");window.location.href="inicio"</script>';
        
        return redirect()->route('inicio');
        }else{
            echo'<script type="text/javascript"> alert("Ocurrió un error al intentar crear el nuevo Usuario, verifíquelo e intente nuevamente");</script>';
            return back();
        }
    }


    public function roles()
    {
        $rol = DB::table('roles')
        ->slect('*')->get()->all();

        return $rol;
    }

    public function salir()
    {

        session()->invalidate();

        return redirect('sesion');
    }
}
