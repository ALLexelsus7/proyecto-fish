<?php
// con "php artisan make:model Favorito -m" para la migracion y modelo
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
        Schema::create('favoritos', function (Blueprint $table) {
            $table->id();
            // Relacion con el usuario
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            // Relacion con el producto
            $table->foreignId('producto_id')->constrained('productos')->onDelete('cascade');
            $table->timestamps();
            // Evita que un usuario duplique el mismo pez en sus favoritos
            $table->unique(['user_id', 'producto_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('favoritos');
    }
};
