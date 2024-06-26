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

Route::get('/', function () {
    return view('index');
})->name('index');

use App\Http\Controllers\PerfilesController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\FacturaController;


Route::middleware(['auth'])->group(function(){ 
Route::resource('perfiles', PerfilesController::class);
/*Route::controller(PerfilesController::class)->group(function(){

Route::get('perfiles','index')->name('perfiles.index');


});*/

Route::resource('clientes', ClienteController::class);
Route::resource('facturas', FacturaController::class);
//Route::resource('facturas', FacturaController::class);
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/passwords', function () {
    return view('login');
});

/*<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\perfilesController;
use App\Http\Controllers\clientesController;
use App\Http\Controllers\FacturasController;
use App\Http\Controllers\formasPagoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\ExcelController;
use App\Http\Controllers\UsuariosController;

Route::get('/', function () {
    return view('index');
})
;
Route::resource('perfiles', perfilesController::class);
Route::resource('clientes', clientesController::class);
Route::resource('facturas', FacturasController::class);
Route::get('pdf', ['as'=>'facturaspdf','uses'=>'App\Http\Controllers\PdfController@facturaspdf']);
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('exportarclientes',['as'=>'exportarclientes','uses'=>'App\Http\Controllers\ExcelController@exportarclientes']);
Route::resource('usuarios', 'App\Http\Controllers\UsuariosController');
Route::get('\mi_ruta', ['middleware'=> 'auth', 'uses' => 'MiControlador@miMetodo']);
Route::get('importarclientes',['as'=>'importarclientes','uses'=>'App\Http\Controllers\ExcelController@importarclientes']);*/
