<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;

class AlmacenController extends Controller
{


    public function llenarMunicipios(){
        $id_estado = $_POST['id_estado'];
        $municipios = DB::table('municipios')->where('id_estado',$id_estado)->orderBy('municipio','asc')->get();
        return json_encode($municipios);
    }

    public function llenarParroquias(){
        $id_parroq = $_POST['id_municipio'];
        $parroquias = DB::table('parroquias')->where('id_municipio',$id_parroq)->orderBy('parroquia','asc')->get();
        return json_encode($parroquias);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
       DB::enableQueryLog();
       $almacenes = DB::table('almacenes')->orderBy('id_almacen')->simplePaginate(15);
       return view('almacen.listaAlmacenes',['almacenes' => $almacenes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $estados = DB::table('estados')->orderBy('estado','asc')->get();
        $tipoAlmacen = DB::table('tipo_almacen')->where('activo', true)->get();
        $condicionAlmacen = DB::table('condicion_almacen')->where('activo', true)->get();
        //dd($condicionAlmacen);
        return view('almacen.newAlmacen',['estados' => $estados, 'tipoAlmacenes' => $tipoAlmacen, 'condicionAlmacenes' => $condicionAlmacen]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    //se lamacenan los datos de la ubicacion para ser almacenados en esa tabla
        $ubicacionAlmacen  = array(
            'id_estado'         => $_POST['estado'],
            'id_municipio'      => $_POST['municipio'],
            'id_parroquia'      => $_POST['parroquia'],
            'direccion'         => $_POST['direccionAlmacen'],
            'cod_postal'        => $_POST['codigoPostal'],
        );

        //se insertan los datos de la unicacion
        $insertUbicacion = DB::table('ubicacion_geografica')->insert($ubicacionAlmacen);


        if ($insertUbicacion == true){
            //si se almacena correctamente  la ubicacion obtenemos el ultimo id generado
            $ultimoId = DB::table('ubicacion_geografica')->latest('id_ubicacion_geografica')->first();

            //aca ingresamos los datos del almacen con el ultimo id insertado en la tabla de ubicacion_geografica
            $almacen = array(
                'nombre_almacen'           => $_POST['nombreAlmacen'],
                'descripcion_almacen'      => $_POST['descripcionAlmacen'],
                'tipo_almacen'             => $_POST['tipoAlmacen'],
                'id_ubicacion_geografica'  => $ultimoId->id_ubicacion_geografica,
                'condicion_almacen'        => $_POST['condicionAlmacen'],
            );
            //se insertan los datos del almacen a la tabla
            $insertAlmacen = DB::table('almacen')->insert($almacen);

        }
        //si los 2 insert se realizan sin problemas procedemos a ingresar los datos a la tabla de logs y redireccionar a la lista de almacenes
        if($insertUbicacion == true && $insertAlmacen == true){
            //dd($insertUbicacion, $insertAlmacen);

            echo '<script type="text/javascript">',
                    'alert("Registro de almacen Exitoso.")',
                 '</script>';
            $inserLog = DB::table('logs')
                        ->insert([
                            'id_usuario' => session('id_usuario'),
                            'fecha_accion' => now(),
                            'accion' => 'Ingreso de un nuevo almacen',
                        ]);
            return redirect()->route('listaAlmacenes');

        }else{
            echo '<script type="text/javascript">',
                    'alert("Fallo al Ingresar los datos del almacen.")',
                 '</script>';
            return redirect()->route('listaAlmacenes');
        }
    }

    public function traspaso()
    {

    }

    public function search()
    {
        $almacenon = DB::table('almacen')
        ->select('*')->get()->all();

        $material = DB::table('material')->select('*')->get()->all();

        return view('almacen.trasAlmacen',['almacenon'=>$almacenon,'materiales'=>$material]);
    }  

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // dd($id);

        $almacen = DB::table('almacen')
        ->join('ubicacion_geografica as dir','dir.id_ubicacion_geografica','=','almacen.id_ubicacion_geografica')
        ->join('estados','estados.id_estado','=','dir.id_estado')
        ->join('municipios','municipios.id_municipio','=','dir.id_municipio')
        ->join('parroquias','parroquias.id_parroquia','=','dir.id_parroquia')
        ->join('tipo_almacen as tipo','tipo.id','=','almacen.tipo_almacen')
        ->join('condicion_almacen as con','con.id','=','almacen.condicion_almacen')
        ->where('id_almacen','=',$id)
        ->select('dir.direccion',
            'estados.estado',
            'municipios.municipio',
            'parroquias.parroquia',
            'tipo.tipo_almacen',
            'almacen.nombre_almacen',
            'almacen.descripcion_almacen',
            'con.condicion_almacen',
            'almacen.activo',
            'dir.cod_postal',
            'almacen.id_almacen',
            'almacen.id_ubicacion_geografica'
        )->get()->first();

        $estados = DB::table('estados')->orderBy('estado','asc')->get();
        $tipoAlmacen = DB::table('tipo_almacen')->where('activo', true)->get();
        $condicionAlmacen = DB::table('condicion_almacen')->where('activo', true)->get();

        // dd($almacen);

        return view('almacen.editAlmacen',['almacen'=>$almacen,'estados' => $estados, 'tipoAlmacenes' => $tipoAlmacen, 'condicionAlmacenes' => $condicionAlmacen]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        // dd($_POST);

        $upDir = array(
            'id_estado'=>$_POST['estado'],
            'id_municipio'=>$_POST['municipio'],
            'id_parroquia'=>$_POST['parroquia'],
        );

        $dir = DB::table('ubicacion_geografica')
        ->where('id_ubicacion_geografica','=',$_POST['id2'])
        ->update($upDir);

        $upAl = array(
            'fecha_registro'=>$_POST['fecha'],
            'nombre_almacen'=>$_POST['nombreAlmacen'],
            'descripcion_almacen'=>$_POST['descripcionAlmacen'],
            'tipo_almacen'=>$_POST['tipoAlmacen'],
            'condicion_almacen'=>$_POST['condicionAlmacen'],
        );

        $alm = DB::table('almacen')
        ->where('id_almacen','=',$_POST['id'])
        ->update($upAl);

        if($dir == true && $alm == true){
            return redirect()->route('listaAlmacenes');
        }else{
        return back();
    }
    }

    public function update($id)
    {
        // dd($id);
        $a = array('activo'=>true);
        $b = array('activo'=>false);

        $alm = DB::table('almacen')
        ->where('id_almacen','=',$id)
        ->select('activo')->get()->first();

        if($alm->activo == true){
        $alm = DB::table('almacen')
        ->where('id_almacen','=',$id)
        ->update($b);
        }elseif($alm->activo == false){
        $alm = DB::table('almacen')
        ->where('id_almacen','=',$id)
        ->update($a);
        }
        return back();
    }

    public function destroy($id)
    {
        //
    }
}
