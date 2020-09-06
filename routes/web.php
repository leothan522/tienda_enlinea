<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function (){
    return view('welcome');
})->name('inicio');

Auth::routes(["register" => false]);

// ruta HOME
Route::get('/home', 'HomeController@index')->name('home');

// rutas Usuarios
Route::resource('usuarios', 'UsersController')->middleware('auth');

// rutas pedidos
Route::resource('pedidos', 'PedidosController')->middleware('auth');
Route::post('pedidos/buscar', 'PedidosController@create_cedula')->name('cedula.create')->middleware('auth');
Route::put('cedula/{id}', 'PedidosController@update_cedula')->name('cedula.update')->middleware('auth');
Route::get('despacho/{id}', 'PedidosController@update_pedido')->name('despacho.update')->middleware('auth');

// rutas buscar Pedidos
Route::post('buscar/cedula', 'BuscarController@cedula')->name('buscar.cedula')->middleware('auth');
Route::post('buscar/referencia', 'BuscarController@referencia')->name('buscar.referencia')->middleware('auth');
Route::post('buscar/factura', 'BuscarController@factura')->name('buscar.factura')->middleware('auth');
Route::post('buscar/fecha', 'BuscarController@fecha')->name('buscar.fecha')->middleware('auth');
Route::get('buscar/fecha/{fecha}', 'BuscarController@fecha_get')->name('buscar.fecha.get')->middleware('auth');

// rutas Llamadas
Route::post('pedidos/llamadas', 'PedidosController@store_llamada')->name('llamada.store')->middleware('auth');
Route::put('pedidos/llamadas/{id}', 'PedidosController@update_llamada')->name('llamada.update')->middleware('auth');

// rutas EXCEL Pedidos
Route::get('/excel/pedidos', 'PedidosController@export')->name('excel.pedidos')->middleware('auth');
Route::get('/excel/pedidos/fecha_sub01', 'HomeController@export_sub01')->name('excel.sub01')->middleware('auth');
Route::get('/excel/pedidos/fecha_sub02', 'HomeController@export_sub02')->name('excel.sub02')->middleware('auth');
Route::get('/excel/pedidos/fecha_sub03', 'HomeController@export_sub03')->name('excel.sub03')->middleware('auth');
Route::get('/excel/pedidos/fecha_sub04', 'HomeController@export_sub04')->name('excel.sub04')->middleware('auth');
Route::get('/excel/pedidos/fecha_sub05', 'HomeController@export_sub05')->name('excel.sub05')->middleware('auth');
Route::get('/excel/pedidos/fecha_sub06', 'HomeController@export_sub06')->name('excel.sub06')->middleware('auth');


// rutas Ventas
Route::resource('ventas', 'VentasController')->middleware('auth');
Route::post('ventas/buscar', 'VentasController@create_cedula')->name('ventas.cedula.create')->middleware('auth');
Route::put('ventas/cedula/{id}', 'VentasController@update_cedula')->name('ventas.cedula.update')->middleware('auth');
Route::get('ventas/despacho/{id}', 'VentasController@update_pedido')->name('ventas.despacho.update')->middleware('auth');

// rutas EXCEL VENTAS
Route::get('/excel/ventas', 'VentasController@export')->name('excel.ventas')->middleware('auth');
Route::get('/excel/ventas/fecha_sub01', 'HomeController@export_sub01v')->name('ventas.excel.sub01')->middleware('auth');
Route::get('/excel/ventas/fecha_sub02', 'HomeController@export_sub02v')->name('ventas.excel.sub02')->middleware('auth');
Route::get('/excel/ventas/fecha_sub03', 'HomeController@export_sub03v')->name('ventas.excel.sub03')->middleware('auth');
Route::get('/excel/ventas/fecha_sub04', 'HomeController@export_sub04v')->name('ventas.excel.sub04')->middleware('auth');
Route::get('/excel/ventas/fecha_sub05', 'HomeController@export_sub05v')->name('ventas.excel.sub05')->middleware('auth');
Route::get('/excel/ventas/fecha_sub06', 'HomeController@export_sub06v')->name('ventas.excel.sub06')->middleware('auth');

// rutas buscar Pedidos web
Route::post('ventas/buscar/cedula', 'BuscarController@cedula_ventas')->name('ventas.buscar.cedula')->middleware('auth');
Route::post('ventas/buscar/referencia', 'BuscarController@referencia_ventas')->name('ventas.buscar.referencia')->middleware('auth');
Route::post('ventas/buscar/factura', 'BuscarController@factura_ventas')->name('ventas.buscar.factura')->middleware('auth');
Route::post('ventas/buscar/pedido', 'BuscarController@pedidos')->name('ventas.buscar.pedido')->middleware('auth');
Route::post('ventas/buscar/fecha', 'BuscarController@ven_fecha')->name('ventas.buscar.fecha')->middleware('auth');
Route::get('ventas/buscar/fecha/{fecha}', 'BuscarController@ven_fecha_get')->name('ventas.buscar.fecha.get')->middleware('auth');

// rutas Import Excel
Route::get('/import/excel', 'ImportController@index')->name('import.index')->middleware('auth');
Route::post('/import/excel', 'ImportController@llamadas')->name('import.llamadas')->middleware('auth');
Route::post('/import/web', 'ImportController@web')->name('import.web')->middleware('auth');

// rutas Clientes
Route::resource('clientes', 'ClientesController')->middleware('auth');

// rutas CNE
Route::get('/cne', 'CNEController@index')->name('cne.index');
Route::post('/cne', 'CNEController@buscar')->name('cne.show');

// rutas Productos
Route::resource('productos', 'ProductosController')->middleware('auth');
Route::get('productos/modulo/create', 'ProductosController@create_mod')->name('mod.create')->middleware('auth');
Route::get('productos/modulo/{id}/edit', 'ProductosController@edit_mod')->name('mod.edit')->middleware('auth');
