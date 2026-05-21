<?php
// Con "php artisan make:model Pedido -m" para modelo + migracion
// Esta es la "Cabecera" de la factura. Solo guarda quién compró, cuánto pagó en total y el estatus logístico.
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
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');            
            // Total de la compra en ese momento
            $table->decimal('total', 10, 2);            
            // Estatus logístico
            $table->enum('estado', ['pendiente', 'enviado', 'entregado', 'cancelado'])->default('pendiente');            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};

// Ejecuto con "php artisan migrate"