<?php
// Con "php artisan make:model Carrito -m" para el modelo y la migracion
// Esta es una tabla pivote avanzada por conectar un user con un product
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
        Schema::create('carritos', function (Blueprint $table) {
            $table->id();            
            // Relacion con el usuario (si el usuario se elimina, se limpia su carrito)
            $table->foreignId('user_id')->constrained()->onDelete('cascade');            
            // Relacion con el producto (apunta a la tabla 'productos')
            $table->foreignId('producto_id')->constrained('productos')->onDelete('cascade');            
            $table->integer('cantidad')->default(1);            
            $table->enum('tipo_compra', ['consumo', 'ornamental'])->default('ornamental');            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carritos');
    }
};
