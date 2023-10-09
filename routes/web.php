<?php

use App\Http\Controllers\EstacionesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ObjetoController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('eventos');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('objeto',ObjetoController::class);
    Route::post('/estaciones/get/',[EstacionesController::class,'get']);
    Route::post('/objeto/get/',[ObjetoController::class,'get']);
    Route::post('/objeto/getReporte/',[ObjetoController::class,'getReporte']);
    Route::get('/objeto/delete/{id}',[ObjetoController::class, 'delete']);


});

require __DIR__.'/auth.php';
