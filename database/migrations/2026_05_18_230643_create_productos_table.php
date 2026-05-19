<?php
// Con "php artisan make:model Producto -m" se creo el Modelo y (-m) migracion de Productos
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
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_comun');
            $table->string('nombre_cientifico')->nullable();
            $table->enum('categoria', ['shallow_coastal', 'oceanic', 'hadal_zone'])->default('hadal_zone');           
            $table->decimal('precio', 10, 2); // Con dos decimales
            $table->integer('stock')->default(0);
            $table->text('descripcion')->nullable();
            $table->string('imagen_url')->nullable();
            $table->boolean('estado_vida')->default(true); //true = vivo/ornamental, false = pescado/consumo
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};

// Ejecute las migraciones con "php artisan migrate:fresh" para borrar las actuales y poner las nuevas