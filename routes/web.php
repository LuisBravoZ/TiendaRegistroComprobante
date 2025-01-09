<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ComprobanteController;

/* Route::get('/', function () {
    return view('welcome');
}); */
Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/comprobantes/exportar-pdf', [ComprobanteController::class, 'exportarPdf'])->name('comprobantes.exportarPdf');

/* Route::get('/dashboard', [ComprobanteController::class, 'index'])->name('dashboard');
require __DIR__.'/auth.php'; */

// Ruta principal que sirve como dashboard
Route::get('/dashboard', [ComprobanteController::class, 'index'])->name('dashboard');

// Ruta para crear comprobantes
Route::get('/comprobantes/create', [ComprobanteController::class, 'create'])->name('comprobantes.create');

// Ruta para almacenar comprobantes
Route::post('/comprobantes', [ComprobanteController::class, 'store'])->name('comprobantes.store');

//ruta edit
Route::put('/comprobantes/{comprobante}', [ComprobanteController::class, 'update'])->name('comprobantes.edit');

Route::resource('comprobantes', ComprobanteController::class);
Route::delete('/comprobantes/{comprobante}', [ComprobanteController::class, 'destroy'])->name('comprobantes.destroy');

Route::get('/buscar', [ComprobanteController::class, 'buscar'])->name('buscar');

require __DIR__.'/auth.php';

