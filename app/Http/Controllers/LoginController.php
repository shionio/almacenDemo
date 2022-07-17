<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Login;
use DB;
use RealRashid\SweetAlert\Facades\Alert;

class LoginController extends Controller
{
    public function index(){
        $articulos = DB::table('material')
                    ->join('almacen','almacen.id_almacen','=','material.id_almacen')
                    ->select('material.id_material',
                              'material.nombre_material',
                              'material.descripcion_material',
                              'material.stock',
                              'material.unidad_medida',
                              'almacen.descripcion_almacen'
                    )->get();
        return view('welcome',['articulos' => $articulos]);
    }


    public function filtrarList(){
        //dd('llega');
        DB::enableQueryLog();
        $palabraClave = $_POST['palabraClave'];
        // dd($palabraClave);
        $filtro =   DB::table('material')
                    ->join('almacen','almacen.id_almacen','=','material.id_almacen')
                    ->join('tipo_almacen','almacen.tipo_almacen','=','tipo_almacen.id')
                    ->where('material.nombre_material','like',"%$palabraClave%")
                    ->orWhere('material.descripcion_material', 'like',"%$palabraClave%")
                    ->orWhere('material.stock', 'like',"%$palabraClave%")
                    ->orWhere('almacen.nombre_almacen', 'like',"%$palabraClave%")
                    ->orWhere('almacen.descripcion_almacen', 'like',"%$palabraClave%")
                    //->orwhere('nom_acueducto','like',"%$palabraClave%")
                    // ->orwhere('nom_mpio','like',"%$palabraClave%")
                    // ->orwhere('nom_parroq','like',"%$palabraClave%")
                    // ->orwhere('nom_sector','like',"%$palabraClave%")
                    // ->orWhere('observaciones', 'like',"%$palabraClave%")
                    // ->orWhere('descrip_estatu', 'like',"%$palabraClave%")
                    // ->orwhere('nom_cliente','like',"%$palabraClave%")
                    // ->orwhere('ape_cliente','like',"%$palabraClave%")
                    // ->orwhere('telefono','like',"%$palabraClave%")
                    // ->orWhere('correo', 'like',"%$palabraClave%")
                    // ->orWhere('pnto_ref', 'like',"%$palabraClave%")
                    // ->orwhere('nic','like',"%$palabraClave%")
                    // ->orWhere('nom_av_calle', 'like',"%$palabraClave%")
                    // ->orWhere('nombreoperador', 'like',"%$palabraClave%")
                    // ->orWhere('apellidooperador', 'like',"%$palabraClave%")

                    ->select('*')
                    //->simplePaginate(10);
                    ->get();
        $query = DB::getQueryLog();
        //dd($query);

        return json_encode($filtro);
    }

    public function check_user(Request $r){

        $usuario = $r->usuario;
        $clave = $r->clave;

        $session = DB::table('usuarios')->where(['usuario'=>$usuario,'activo'=> true])
        ->select('*')->get()->first();
        //dd($session);

        if($session->activo == false){
            echo'<script type="text/javascript"> alert("Este Usuario se Encuentra Inactivo");window.location.href="/"</script>';
        
        }elseif (password_verify($r->clave, $session->password)){


            session([
                'id_usuario'    => $session->id_usuario,
                'usuario'       => $session->usuario,
                'rol'           => $session->id_rol,
                'id_almacen'    => $session->id_almacen,
            ]);
            $time = time();
            $inserLog = DB::table('logs')->insert([
                                                    'id_usuario' => $session->id_usuario,
                                                    'fecha_accion' => date("d-m-Y (H:i:s)",$time),
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

    public function list()
    {
        $user = DB::table('usuarios')
        ->join('roles','roles.id_rol','=','usuarios.id_rol')
        ->select('*')->get()->all();

        // dd($user);

        return view('usuarios.list',['lista'=>$user]);
    }


    public function roles()
    {
        $rol = DB::table('roles')
        ->select('*')->get()->all();

        return $rol;
    }

    public function salir()
    {

        session()->invalidate();

        return redirect('/');
    }
}
