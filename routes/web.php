<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

//Rutas publicas
Route::get('/', function () {
    return view('home'); 
})->name('home');
Route::get('/productos', function () {
    return view('productos');
})->name('productos');
Route::get('/contacto', function () {
    return view('contacto');
})->name('contacto');

//Rutas protegidas
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';