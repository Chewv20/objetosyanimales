<?php

use App\Http\Controllers\EventosController;
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
    Route::post('/eventos/getLarin', [EventosController::class, 'getLarin']);
    Route::post('/eventos/getLinea',[EventosController::class, 'getLinea']);
    Route::post('/eventos/getReporte',[EventosController::class, 'getReporte']);
});

require __DIR__.'/auth.php';
