<?php
// Con "php artisan make:model DetallePedido -m" para modelo + migracion
// Aqui se copian los datos del carrito y se "congelan" por si luego se 
// cambian los precios, aqui se mantienen los detalles pasados.
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('detalle_pedidos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pedido_id')->constrained()->onDelete('cascade');            
            // Aunque el producto se borre del catálogo, se conserva la referencia en null o dejándola
            $table->foreignId('producto_id')->nullable()->constrained('productos')->onDelete('set null');            
            $table->integer('cantidad');            
            // Precio "congelado" al momento de compra
            $table->decimal('precio_unitario', 10, 2);            
            // Tipo de compra elegido en ese momento
            $table->enum('tipo_compra', ['consumo', 'ornamental']);            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_pedidos');
    }
};

// Ejecuto con "php artisan migrate"