<?php

use App\Http\Controllers\AnimalesController;
use App\Http\Controllers\EstacionesController;
use App\Http\Controllers\Estaciones2Controller;
use App\Http\Controllers\EstadisticasController;
use App\Http\Controllers\AccidentadosController;
use App\Http\Controllers\IncidentesrelevantesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ObjetoController;
use App\Http\Controllers\PersonasajenasController;
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
    Route::resource('accidentados',AccidentadosController::class);
    Route::resource('personasajenas',PersonasajenasController::class);
    Route::resource('incidentesrelevantes',IncidentesrelevantesController::class);

    Route::post('/estaciones/get/',[EstacionesController::class,'get']);
    Route::post('/estaciones2/get/',[Estaciones2Controller::class,'get']);
    Route::post('/objeto/get/',[ObjetoController::class,'get']);
    Route::post('/objeto/getReporte/',[ObjetoController::class,'getReporte']);
    Route::get('/objeto/delete/{id}',[ObjetoController::class, 'delete']);

    Route::post('/animales/get/',[AnimalesController::class,'get']);
    Route::post('/animales/getReporte/',[AnimalesController::class,'getReporte']);
    Route::get('/animales/delete/{id}',[AnimalesController::class, 'delete']);
    
    Route::post('/accidentados/get/',[AccidentadosController::class,'get']);
    Route::post('/accidentados/getReporte/',[AccidentadosController::class,'getReporte']);
    Route::get('/accidentados/delete/{id}',[AccidentadosController::class, 'delete']);

    Route::post('/personasajenas/get/',[PersonasajenasController::class,'get']);
    Route::post('/personasajenas/getReporte/',[PersonasajenasController::class,'getReporte']);
    Route::get('/personasajenas/delete/{id}',[PersonasajenasController::class, 'delete']);

    Route::post('/incidentesrelevantes/get/',[IncidentesrelevantesController::class,'get']);
    Route::post('/incidentesrelevantes/getReporte/',[IncidentesrelevantesController::class,'getReporte']);
    Route::get('/incidentesrelevantes/delete/{id}',[IncidentesrelevantesController::class, 'delete']);

    Route::post('/estadisticas/getcuentas',[EstadisticasController::class, 'getCount']);


});

require __DIR__.'/auth.php';
