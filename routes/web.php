<?php

use App\Http\Controllers\AnexoiiController;
use App\Http\Controllers\AnexoIIIController;
use App\Http\Controllers\EventosController;
use App\Http\Controllers\LarinIController;
use App\Http\Controllers\LarinIIController;
use App\Http\Controllers\ProfileController;
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

Route::get('/eventos', function () {
    return view('eventos.index');
})->middleware(['auth', 'verified'])->name('eventos');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('eventos', EventosController::class);
    Route::resource('anexoii', AnexoiiController::class);
    Route::resource('anexoIII', AnexoIIIController::class);
    Route::resource('larinI', LarinIController::class);
    Route::resource('larinII', LarinIIController::class);
    Route::post('/eventos/getLarin', [EventosController::class, 'getLarin']);
    Route::post('/eventos/getLinea',[EventosController::class, 'getLinea']);
    Route::post('/eventos/getLineaF',[EventosController::class, 'getLineaF']);
    Route::post('/eventos/getReporte',[EventosController::class, 'getReporte']);
    Route::get('/eventos/delete/{id}',[EventosController::class, 'delete']);
    Route::get('/eventos/pdf/{fecha}/{oficio}',[EventosController::class,'imprimir']);
    Route::post('/anexoii/getLarin', [AnexoiiController::class, 'getLarin']);
    Route::post('/anexoii/getLinea',[AnexoiiController::class, 'getLinea']);
    Route::post('/anexoii/getLineaF',[AnexoiiController::class, 'getLineaF']);
    Route::post('/anexoii/getReporte',[AnexoiiController::class, 'getReporte']);
    Route::get('/anexoii/delete/{id}',[AnexoiiController::class, 'delete']);
    Route::post('/larinI/get',[LarinIController::class, 'get']);
    Route::post('anexoIII/get', [AnexoIIIController::class,'get']);
    Route::post('anexoIII/getvueltas', [AnexoIIIController::class,'getVueltas']);

    
});

require __DIR__.'/auth.php';
