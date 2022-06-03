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
        DB::enableQueryLog();
        $usuario = $r->usuario;
        $clave = $r->clave;

        $session = DB::table('usuarios')->where(['usuario'=>$usuario,'password'=>$clave,'activo'=> true])->get();
        $query = DB::getQueryLog();
        //dd($query);



        if (count($session)>0){

            $r->session()->put('id_usuario',$session[0]->id_usuario);
            $r->session()->put('usuario',$session[0]->usuario);
            $r->session()->put('rol',$session[0]->id_rol);
            //$r->session()->put('msg','Usuario Valido');

            $inserLog = DB::table('logs')->insert([
                                                    'id_usuario' => $session[0]->id_usuario,
                                                    'fecha_accion' => now(),
                                                    'accion' => 'Inicio de sesion',
                                                ]);
            return redirect('inicio');
        }else{
            return redirect('/')->with('msg','Datos Invalidos');
        }
    }

    public function salir()
    {
        // $req = session()->all();

        // dd($req);

        session()->invalidate();

        return redirect('/');
    }
}
