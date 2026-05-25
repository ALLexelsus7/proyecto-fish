<?php
// Recuerda poner todos los controladores aqui!!!
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\FavoritoController;
use App\Http\Controllers\AdminDashboardController;
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
    //Dashboard de usuario (ahora con controlador)
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
    Route::post('/favoritos/toggle/{id}', [FavoritoController::class, 'toggle'])->name('favoritos.toggle');
    // Agregar, leer, eliminar y actualizar productos del carrito
    Route::post('/carrito/add', [CarritoController::class, 'store'])->name('carrito.add');
    Route::get('/carrito/items', [CarritoController::class, 'getCarrito'])->name('carrito.get');
    Route::delete('/carrito/remove/{id}', [CarritoController::class, 'destroy'])->name('carrito.remove');
    Route::patch('/carrito/update/{id}', [CarritoController::class, 'update'])->name('carrito.update');
    // RUTA DEL DISPARADOR FINAL (Hacer pedido)
    Route::post('/checkout', [PedidoController::class, 'procesarCheckout'])->name('checkout.process');

    //☼☼☼☼☼☼☼☼☼☼☼ RUTAS DEL ADMIN ☼☼☼☼☼☼☼☼☼☼☼//
    // Gestion del catalogo (ahora con controlador)
    Route::get('/admin/productos', [ProductoController::class, 'index'])->name('admin.productos.index');
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
    //Dashboard admin (ahora con controlador)
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    // Actualizar estatus de pedido
    Route::patch('/admin/pedidos/{pedido}/estatus', [AdminDashboardController::class, 'updateEstatus'])
    ->name('admin.pedidos.estatus');

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
php artisan view:clear
*/