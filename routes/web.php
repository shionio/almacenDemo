<?php

use Illuminate\Support\Facades\Route;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\FamiliaController;
use App\Http\Controllers\AlmacenController;
use App\Http\Controllers\ArticulosController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\MovimientosController;
use App\Http\Controllers\EstadisticasController;
use App\Http\Controllers\ReportesController;



// eliminar erstas rutas luego
use App\Http\Controllers\VehiculosController;
use App\Http\Controllers\ProgramacionController;
// hasta aqui

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('login');
    });

Route::view('/inicio','layouts.dashboard');
Route::get('/lista',[LoginController::class, 'list'])->name('lista.user');
Route::get('/salir', [LoginController::class, 'salir'])->name('salir');
Route::post('/roles',[LoginController::class,'roles'])->name('rolUser');
Route::get('inicio', [LoginController::class, 'index'])->name('inicio');
Route::post('/check', [LoginController::class, 'check_user']);
Route::post('/registro',[LoginController::class, 'registrar'])->name('registroUser');
Route::get('/nuevo/usuario', [LoginController::class, 'nuevo'])->name('nuevoUser');
Route::post('/material/filtroLista',[LoginController::class, 'filtrarList']);

/*rutas de almacen*/
Route::get('/Almacen', [AlmacenController::class , 'index'])->name('listaAlmacenes');
Route::get('/Almacen/Nuevo', [AlmacenController::class , 'create'])->name('newAlmacen');
Route::post('/guardarAlmacen',[AlmacenController::class, 'store']);
Route::get('/Almacen/Ver/{id}',[AlmacenController::class, 'show'])->name('VerAlmacen');
Route::post('Almacen/Editar/',[AlmacenController::class, 'edit'])->name('editarAlmacen');
Route::get('/Almacen/estatus/{id}',[AlmacenController::class, 'update'])->name('estatusAlmacen');
Route::post('/Almacen/traspaso',[AlmacenController::class,'traspaso'])->name('traspasoAlmacen');
Route::get('/buscarAlmacen',[AlmacenController::class,'search'])->name('buscarAlmacenorigen');
Route::post('/llenarMunicipios',[AlmacenController::class, 'llenarMunicipios']);
Route::post('/llenarParroquias',[AlmacenController::class, 'llenarParroquias']);
/*fin de rutas de almacen*/

/*rutas de articulos*/
Route::get('Articulos',[ArticulosController::class, 'index'])->name('listaArticulos');
Route::get('/Articulo/Nuevo', [ArticulosController::class , 'create'])->name('newArticulo');
Route::post('/guardarMaterial',[ArticulosController::class, 'store']);
Route::post('/Guardar/Material',[ArticulosController::class,'nuevoMaterial'])->name('nuevoMat');
/*fin de rutas de articulos*/

/* Proveedores */

Route::view('/proveedores/nuevo','proveedores.nproveedor')->name('nuevo.proveedor');
Route::get('/proveedores/lista',[ProveedorController::class,'listProveedor'])->name('lista.proveedor');
Route::post('/proveedores/guardar',[ProveedorController::class,'newProveedor'])->name('guardar.proveedor');
Route::get('/proveedor/mostar/{id}',[ProveedorController::class,'editarPro'])->name('ver.proveedor');
Route::post('/proveedores/actualizar',[ProveedorController::class,'actualizarProveedor'])->name('actualizar.proveedor');
Route::get('/proveedores/estatus/{id}',[ProveedorController::class,'update'])->name('estatus.proveedor');

/*Solicitudes*/

Route::post('traerStock',[MovimientosController::class,'traerStock']);
Route::get('/Solicitudes',[MovimientosController::class,'index'])->name('listaSolicitudes');
Route::post('/editarSolicitud',[MovimientosController::class,'editarSolicitud']);
Route::post('/llenarAlmaDesti',[MovimientosController::class,'buscarAlmaDesti']);
Route::post('/guardarSolicitud',[MovimientosController::class,'store']);
Route::post('/entradaPorTraspaso',[MovimientosController::class,'entradaPorTraspaso']);
Route::get('/Solicitudes/pdf/{id}',[MovimientosController::class,'solicitudPDF'])->name('solicitudPdf');



Route::post('/movimiento/anulacion/{id_solicitud}',[MovimientosController::class,'anularSolicitud'])->name('anularSolicitud');


Route::get('/entradas/listas',[MovimientosController::class, 'listEnt'])->name('entrada.lista');
Route::post('/guardarMovimiento',[MovimientosController::class, 'guardarEntradaMaterial']);
Route::post('/guardarSalidaMaterial',[MovimientosController::class, 'guardarSalidaMaterial']);
Route::get('/movimientos/salidaMaterial',[MovimientosController::class, 'mostrarSalidaMaterial'])->name('newMovSalida');
Route::get('/movimientos/entradaMaterial',[MovimientosController::class, 'nuevaEntrada'])->name('newEntradaMaterial');

Route::post('/movimientos/almacen',[MovimientosController::class,'alminv'])->name('inv.almacenes');

Route::get('/verSolicitud/{id_solicitud}',[MovimientosController::class,'show'])->name('verSolicitud');

Route::post('/solicitudes/material',[MovimientosController::class,'material'])->name('VerMaterial');


Route::post('/guardarEntrada',[MovimientosController::class, 'guadarEntradaMaterial']);
Route::post('/recibeSolicitud',[MovimientosController::class,'recibe']);
Route::post('/actualizarSolicitud',[MovimientosController::class,'update']);
Route::post('/solicitudAprobada',[MovimientosController::class,'aprobada']);

Route::get('/solicitudes',[MovimientosController::class, 'index'])->name('listaMovimientos');


Route::get('/Solicitudes/NuevaSolicitud',[MovimientosController::class,'create'])->name('newSolicitud');
Route::get('/movimientos/entradaPorTraspaso',[MovimientosController::class,'entradaMaterial'])->name('entradaMaterial');
Route::get('/AprobarSolicitud/{id_solicitud}',[MovimientosController::class,'aprobar'])->name('aprobarSolicitud');
Route::get('/RecibirSolicitud/{id_solicitud}',[MovimientosController::class,'recibir'])->name('recibirSolicitud');

Route::get('/totales/articulos',[EstadisticasController::class,'estArticulos'])->name('estadisticas.articulos');
Route::get('/totales/barras/{id_familia}',[EstadisticasController::class,'estBarras'])->name('estadisticas.barras');
Route::get('/totales/barras1/{id_material}',[EstadisticasController::class,'estBarras1'])->name('estadisticas.barrasArt');
Route::post('/totales/barrasFil/',[EstadisticasController::class,'estBarrasFil'])->name('estadisticas.barrasFil');
Route::post('/totales/buscar',[EstadisticasController::class,'BuscarEnAlmacen'])->name('Buscar.totalesAlmacen');
Route::get('/buscar/material',[EstadisticasController::class,'BuscarMat'])->name('BuscarMaterial');
Route::post('/llenar/material',[EstadisticasController::class,'TomarMat'])->name('llenarMaterial');
Route::post('/mostrar/material',[EstadisticasController::class,'LlenarMat'])->name('Grafica.Mat');
// Route::view('/probando123','estadisticas.estadisticasArticulos')->name('estadisticas.articulos');

Route::get('/familia', [FamiliaController::class,'create'])->name('nuevaFamilia');
Route::post('/guardarFamilia', [FamiliaController::class,'store']);


// REPORTES

Route::get('/reportes/filtro',[ReportesController::class,'reporteFiltro'])->name('filtrar.reporte');
Route::get('/reportes/generar',[ReportesController::class,'reporteGeneral'])->name('generar.reporte');
Route::post('/reporte/buscar',[ReportesController::class, 'filtroReporte'])->name('buscar.reporte');