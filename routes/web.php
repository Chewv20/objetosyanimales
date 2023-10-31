<?php

use App\Http\Controllers\AnimalesController;
use App\Http\Controllers\EstacionesController;
use App\Http\Controllers\Estaciones2Controller;
use App\Http\Controllers\EstacionesviasController;
use App\Http\Controllers\EstadisticasController;
use App\Http\Controllers\AccidentadosController;
use App\Http\Controllers\ArrolladosController;
use App\Http\Controllers\CablesController;
use App\Http\Controllers\EstacionessiController;
use App\Http\Controllers\IncidentesrelevantesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ObjetoController;
use App\Http\Controllers\PersonasajenasController;
use App\Http\Controllers\PuertasController;
use App\Http\Controllers\ZapatasController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/estadisticas', function () {
    return view('inicio');
})->middleware(['auth', 'verified'])->name('inicio');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('estadisticas',EstadisticasController::class);
    Route::resource('objeto',ObjetoController::class);
    Route::resource('animales',AnimalesController::class);
    Route::resource('arrollados',ArrolladosController::class);
    Route::resource('accidentados',AccidentadosController::class);
    Route::resource('personasajenas',PersonasajenasController::class);
    Route::resource('incidentesrelevantes',IncidentesrelevantesController::class);
    Route::resource('puertas',PuertasController::class);
    Route::resource('zapatas',ZapatasController::class);
    Route::resource('cables',CablesController::class);

    Route::post('/estaciones/get/',[EstacionesController::class,'get']);
    Route::post('/estacionessi/get/',[EstacionessiController::class,'get']);

    Route::post('/objeto/get/',[ObjetoController::class,'get']);
    Route::post('/objeto/getReporte/',[ObjetoController::class,'getReporte']);
    Route::get('/objeto/delete/{id}',[ObjetoController::class, 'delete']);
    Route::post('/objeto/getfiltro/',[ObjetoController::class,'getFiltro']);

    Route::post('/animales/get/',[AnimalesController::class,'get']);
    Route::post('/animales/getfiltro/',[AnimalesController::class,'getFiltro']);
    Route::post('/animales/getReporte/',[AnimalesController::class,'getReporte']);
    Route::get('/animales/delete/{id}',[AnimalesController::class, 'delete']);
    
    Route::post('/accidentados/get/',[AccidentadosController::class,'get']);
    Route::post('/accidentados/getReporte/',[AccidentadosController::class,'getReporte']);
    Route::post('/accidentados/getfiltro/',[AccidentadosController::class,'getFiltro']);
    Route::get('/accidentados/delete/{id}',[AccidentadosController::class, 'delete']);

        
    Route::post('/arrollados/get/',[ArrolladosController::class,'get']);
    Route::post('/arrollados/getReporte/',[ArrolladosController::class,'getReporte']);
    Route::post('/arrollados/getfiltro/',[ArrolladosController::class,'getFiltro']);
    Route::get('/arrollados/delete/{id}',[ArrolladosController::class, 'delete']);
    
    Route::post('/personasajenas/get/',[PersonasajenasController::class,'get']);
    Route::post('/personasajenas/getReporte/',[PersonasajenasController::class,'getReporte']);
    Route::post('/personasajenas/getfiltro/',[PersonasajenasController::class,'getFiltro']);
    Route::get('/personasajenas/delete/{id}',[PersonasajenasController::class, 'delete']);
    
    Route::post('/incidentesrelevantes/get/',[IncidentesrelevantesController::class,'get']);
    Route::post('/incidentesrelevantes/getReporte/',[IncidentesrelevantesController::class,'getReporte']);
    Route::post('/incidentesrelevantes/getfiltro/',[IncidentesrelevantesController::class,'getFiltro']);
    Route::get('/incidentesrelevantes/delete/{id}',[IncidentesrelevantesController::class, 'delete']);
    
    Route::post('/puertas/get/',[PuertasController::class,'get']);
    Route::post('/puertas/getReporte/',[PuertasController::class,'getReporte']);
    Route::post('/puertas/getfiltro/',[PuertasController::class,'getFiltro']);
    Route::get('/puertas/delete/{id}',[PuertasController::class, 'delete']);
    
    Route::post('/zapatas/get/',[ZapatasController::class,'get']);
    Route::post('/zapatas/getReporte/',[ZapatasController::class,'getReporte']);
    Route::post('/zapatas/getfiltro/',[ZapatasController::class,'getFiltro']);
    Route::get('/zapatas/delete/{id}',[ZapatasController::class, 'delete']);

    Route::post('/cables/get/',[CablesController::class,'get']);
    Route::post('/cables/getReporte/',[CablesController::class,'getReporte']);
    Route::post('/cables/getfiltro/',[CablesController::class,'getFiltro']);
    Route::get('/cables/delete/{id}',[CablesController::class, 'delete']);

    Route::post('/estadisticas/getcuentas',[EstadisticasController::class, 'getCount']);
    Route::post('/estadisticas/getall',[EstadisticasController::class,'getAll']);


});

require __DIR__.'/auth.php';
