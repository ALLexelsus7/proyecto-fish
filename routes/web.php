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

//► Rutas publicas (sin loguear)
Route::get('/', function () { return view('home'); })->name('home');
Route::get('/productos', [ProductoController::class, 'index'])->name('productos.index');
Route::get('/contacto', function () { return view('contacto'); })->name('contacto');

//► Grupo de rutas protegidas (para los logueados y verificados)
Route::middleware(['auth','verified'])->group(function () {

    //☼☼☼☼☼☼☼☼☼☼☼ RUTAS DEL USUARIO ☼☼☼☼☼☼☼☼☼☼☼//
    //Dashboard de usuario (ahora con controlador)
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
    Route::post('/favoritos/toggle/{id}', [FavoritoController::class, 'toggle'])->name('favoritos.toggle');

    // Perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');  

    // Agregar, leer, eliminar y actualizar productos del carrito
    Route::post('/carrito/add', [CarritoController::class, 'store'])->name('carrito.add');
    Route::get('/carrito/items', [CarritoController::class, 'getCarrito'])->name('carrito.get');
    Route::delete('/carrito/remove/{id}', [CarritoController::class, 'destroy'])->name('carrito.remove');
    Route::patch('/carrito/update/{id}', [CarritoController::class, 'update'])->name('carrito.update');
    
    // DISPARADOR FINAL (Hacer pedido o checkout)
    Route::post('/checkout', [PedidoController::class, 'procesarCheckout'])->name('checkout.process');

    //☼☼☼☼☼☼☼☼☼☼☼ RUTAS DEL ADMIN ☼☼☼☼☼☼☼☼☼☼☼//
    // Solo el admin puede entrar a estas rutas. Se agrega el prefijo y nombre para ahorrar escribirlo.
    Route::middleware(['admin'])->prefix('admin')->name('admin.')->group(function () {
        //Dashboard admin (ahora con controlador)
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        // Actualizar estatus de pedido
        Route::patch('/pedidos/{pedido}/estatus', [AdminDashboardController::class, 'updateEstatus'])->name('pedidos.estatus');
        // Ver detalles de pedido
        Route::get('/pedidos/{pedido}/detalles', [AdminDashboardController::class, 'getDetalles'])->name('pedidos.detalles');

        // Gestion del inventario (ahora con controlador)
        Route::get('/productos', [ProductoController::class, 'adminIndex'])->name('productos.index');
        // Vista de Crear y funcion para guardar producto
        Route::get('/productos/create', [ProductoController::class, 'create'])->name('productos.create');
        Route::post('/productos', [ProductoController::class, 'store'])->name('productos.store');
        // Actualización rápida de stock desde la tabla (vía AJAX/Axios)
        Route::patch('/productos/{producto}/stock', [ProductoController::class, 'updateStock'])->name('productos.updateStock');  
        // Vista de editar y funcion para editar producto
        Route::get('/productos/{producto}/edit', [ProductoController::class, 'edit'])->name('productos.edit');
        Route::put('/productos/{producto}', [ProductoController::class, 'update'])->name('productos.update');
        // Funcion para eliminar producto
        Route::delete('/productos/{producto}', [ProductoController::class, 'destroy'])->name('productos.destroy');
    });
    
});

require __DIR__.'/auth.php';

/*
Con estos comandos se limpia el cache de las rutas:
php artisan route:clear
php artisan optimize:clear
php artisan view:clear
*/