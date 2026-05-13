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
Route::middleware(['auth','verified'])->group(function () {

    //Rutas de usuario
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    //Dashboard de usuario
    Route::get('/dashboard', function () { return view('dashboard'); })->name('dashboard');

    //Rutas de admin
    Route::get('/admin/productos', function () {
        // Simulamos datos
        $productos = [
            (object)[
                'id' => 1,
                'nombre' => 'Pez Quimera',
                'categoria' => 'Abisal',
                'precio' => 1500,
                'stock' => 5,
                'imagen' => 'fish1.png'
            ],
            (object)[
                'id' => 2,
                'nombre' => 'Rape Abisal',
                'categoria' => 'Abisal',
                'precio' => 2200,
                'stock' => 0,
                'imagen' => 'fish2.png'
            ],
        ];
        return view('admin.productos.index', compact('productos'));
    })->name('admin.productos.index');

    // Ruta para el formulario de crear (la usaremos después)
    Route::get('/admin/productos/create', function () {
        return view('admin.productos.create');
    })->name('admin.productos.create');

    
});

require __DIR__.'/auth.php';