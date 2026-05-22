<?php
// Recuerda poner todos los controladores aqui!!!
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CarritoController;
use Illuminate\Support\Facades\Route;

//► Rutas publicas
Route::get('/', function () { return view('home'); })->name('home');
Route::get('/productos', [ProductoController::class, 'index'])->name('productos.index'); //Aqui uso el controlador de productos
Route::get('/contacto', function () { return view('contacto'); })->name('contacto');

//► Grupo de rutas protegidas
Route::middleware(['auth','verified'])->group(function () {

    //☼☼☼☼☼☼☼☼☼☼☼ RUTAS DEL USUARIO ☼☼☼☼☼☼☼☼☼☼☼//
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    //Dashboard de usuario
    Route::get('/dashboard', function () { return view('dashboard'); })->name('dashboard');
    // Agregar, leer, eliminar y actualizar productos del carrito
    Route::post('/carrito/add', [CarritoController::class, 'store'])->name('carrito.add');
    Route::get('/carrito/items', [CarritoController::class, 'getCarrito'])->name('carrito.get');
    Route::delete('/carrito/remove/{id}', [CarritoController::class, 'destroy'])->name('carrito.remove');
    Route::patch('/carrito/update/{id}', [CarritoController::class, 'update'])->name('carrito.update');
    // RUTA DEL DISPARADOR FINAL (Hacer pedido)
    Route::post('/checkout', [PedidoController::class, 'procesarCheckout'])->name('checkout.process');

    //☼☼☼☼☼☼☼☼☼☼☼ RUTAS DEL ADMIN ☼☼☼☼☼☼☼☼☼☼☼//
    // Gestion del catalogo
    Route::get('/admin/productos', function () {
        // Simula datos por ahora
        $productos = [
            (object)['id' => 1,'nombre' => 'Pez Quimera','categoria' => 'Abisal','precio' => 1500,'stock' => 5,'imagen' => 'fish1.png'],
            (object)['id' => 2,'nombre' => 'Rape Abisal','categoria' => 'Abisal','precio' => 2200,'stock' => 0,'imagen' => 'fish2.png'],
        ];
        return view('admin.productos.index', compact('productos'));
    })->name('admin.productos.index');
    // Formulario de crear
    Route::get('/admin/productos/create', function () {
        return view('admin.productos.create');
    })->name('admin.productos.create');
    //Formulario editar
    Route::get('/admin/productos/{id}/edit', function ($id) {
        // Simula que busca el producto en MySQL por ahora
        $producto = (object)['id' => $id,'nombre_comun' => 'Pez de Prueba','nombre_cientifico' => 'Pruebus scientificus','categoria' => 'Consumo','precio' => 999.99,'stock' => 10,'descripcion' => 'Descripción de prueba para ver el formulario lleno.','imagen_url' => 'default.png'];
        return view('admin.productos.edit', compact('producto'));
    })->name('admin.productos.edit');
    //Dashboard admin
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // --- RUTAS FALSAS (Para que los formularios no den error antes del Sprint 2) ---
    Route::put('/admin/productos/{id}', function($id) {
        return redirect()->route('admin.productos.index');
    })->name('admin.productos.update');

    Route::delete('/admin/productos/{id}', function($id) {
        return redirect()->route('admin.productos.index');
    })->name('admin.productos.destroy');
    
});

require __DIR__.'/auth.php';

/*
Con estos comandos se limpia el cache de las rutas:
php artisan route:clear
php artisan optimize:clear
*/