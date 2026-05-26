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
Route::get('/productos', [ProductoController::class, 'index'])->name('productos.index');
Route::get('/contacto', function () { return view('contacto'); })->name('contacto');

//► Grupo de rutas protegidas
Route::middleware(['auth','verified'])->group(function () {

    //☼☼☼☼☼☼☼☼☼☼☼ RUTAS DEL USUARIO ☼☼☼☼☼☼☼☼☼☼☼//
    //Dashboard de usuario (ahora con controlador)
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
    Route::post('/favoritos/toggle/{id}', [FavoritoController::class, 'toggle'])->name('favoritos.toggle');
    // Rutas de perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');    
    // Agregar, leer, eliminar y actualizar productos del carrito
    Route::post('/carrito/add', [CarritoController::class, 'store'])->name('carrito.add');
    Route::get('/carrito/items', [CarritoController::class, 'getCarrito'])->name('carrito.get');
    Route::delete('/carrito/remove/{id}', [CarritoController::class, 'destroy'])->name('carrito.remove');
    Route::patch('/carrito/update/{id}', [CarritoController::class, 'update'])->name('carrito.update');
    // RUTA DEL DISPARADOR FINAL (Hacer pedido)
    Route::post('/checkout', [PedidoController::class, 'procesarCheckout'])->name('checkout.process');

    //☼☼☼☼☼☼☼☼☼☼☼ RUTAS DEL ADMIN ☼☼☼☼☼☼☼☼☼☼☼//
    //Dashboard admin (ahora con controlador)
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    // Actualizar estatus de pedido
    Route::patch('/admin/pedidos/{pedido}/estatus', [AdminDashboardController::class, 'updateEstatus'])
    ->name('admin.pedidos.estatus');
    // Ver detalles de pedido
    Route::get('/admin/pedidos/{pedido}/detalles', [AdminDashboardController::class, 'getDetalles'])
    ->name('admin.pedidos.detalles');
    // Gestion del inventario (ahora con controlador)
    Route::get('/admin/productos', [ProductoController::class, 'adminIndex'])->name('admin.productos.index');
    // Actualización rápida de stock desde la tabla (vía AJAX/Axios)
    Route::patch('/admin/productos/{producto}/stock', [ProductoController::class, 'updateStock'])->name('admin.productos.updateStock');
    // Formulario de Crear y ruta para recibir y guardar 
    Route::get('/admin/productos/create', [ProductoController::class, 'create'])->name('admin.productos.create');
    Route::post('/admin/productos', [ProductoController::class, 'store'])->name('admin.productos.store');
    
    Route::get('/admin/productos/{producto}/edit', [ProductoController::class, 'edit'])->name('admin.productos.edit');
    Route::put('/admin/productos/{producto}', [ProductoController::class, 'update'])->name('admin.productos.update');
    Route::delete('/admin/productos/{producto}', [ProductoController::class, 'destroy'])->name('admin.productos.destroy');
    
});

require __DIR__.'/auth.php';

/*
Con estos comandos se limpia el cache de las rutas:
php artisan route:clear
php artisan optimize:clear
php artisan view:clear
*/