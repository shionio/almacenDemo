<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AlmacenController;
use App\Http\Controllers\ArticulosController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\MovimientosController;




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

Route::get('inicio', [LoginController::class, 'index'])->name('inicio');
Route::post('/check', [LoginController::class, 'check_user']);
Route::get('/salir', [LoginController::class, 'salir'])->name('salir');

/*rutas de almacen*/
Route::get('/Almacen', [AlmacenController::class , 'index'])->name('listaAlmacenes');
Route::get('/Almacen/Nuevo', [AlmacenController::class , 'create'])->name('newAlmacen');
Route::post('/guardarAlmacen',[AlmacenController::class, 'store']);
Route::get('/Almacen/Ver/{id}',[AlmacenController::class, 'show'])->name('VerAlmacen');
Route::post('Almacen/Editar/',[AlmacenController::class, 'edit'])->name('editarAlmacen');
Route::get('/Almacen/estatus/{id}',[AlmacenController::class, 'update'])->name('estatusAlmacen');
// Route::view('/Traspaso','almacen.trasAlmacen')->name('traspaso');
Route::post('/Almacen/traspaso',[AlmacenController::class,'traspaso'])->name('traspasoAlmacen');
Route::get('/buscarAlmacen',[AlmacenController::class,'search'])->name('buscarAlmacenorigen');
Route::post('/llenarMunicipios',[AlmacenController::class, 'llenarMunicipios']);
Route::post('/llenarParroquias',[AlmacenController::class, 'llenarParroquias']);
/*fin de rutas de almacen*/

/*rutas de articulos*/
Route::get('Articulos',[ArticulosController::class, 'index'])->name('listaArticulos');
Route::get('/Articulo/Nuevo', [ArticulosController::class , 'create'])->name('newArticulo');
Route::post('/guardarArticulo',[ArticulosController::class, 'store']);
/*fin de rutas de articulos*/



Route::post('/llenarModelo',[VehiculosController::class, 'llenarModelo']);
Route::post('buscarVehiculo', [VehiculosController::class, 'buscarVehiculo'])->name('buscarVehiculo');



Route::get('/programacion', [ProgramacionController::class , 'index'])->name('listaProgramacion');
Route::get('/nuevaProgramacion', [ProgramacionController::class , 'create'])->name('newProgramacion');
Route::post('/guardarProgramacion',[ProgramacionController::class, 'store']);

/* Proveedores */

Route::get('/proveedores/lista',[ProveedorController::class,'listProveedor'])->name('lista.proveedor');
Route::post('/proveedores/guardar',[ProveedorController::class,'newProveedor'])->name('guardar.proveedor');
Route::view('/proveedores/nuevo','proveedores.nproveedor')->name('nuevo.proveedor');
Route::get('/proveedor/mostar/{id}',[ProveedorController::class,'editarPro'])->name('ver.proveedor');
Route::post('/proveedores/estatus',[ProveedorController::class,'update'])->name('estatus.proveedor');

/*Solicitudes*/

Route::get('/Solicitudes',[MovimientosController::class,'index'])->name('listaMovimientos');
Route::get('/Solicitudes/NuevaSolicitud',[MovimientosController::class,'create'])->name('newSolicitud');
Route::post('/llenarAlmaDesti',[MovimientosController::class,'buscarAlmaDesti']);
Route::post('traerStock',[MovimientosController::class,'traerStock']);
Route::post('/guardarSolicitud',[MovimientosController::class,'store']);

