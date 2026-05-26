<?php
// con "php artisan make:migration alter_atributes_on_productos_table --table=productos"
// hice esta migracion para modificar que algunos atributos ya no sean ->nullable()
// y se ejecuta con "php artisan migrate" sin alterar los datos de la tabla
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
        Schema::table('productos', function (Blueprint $table) {
            // El método ->change() le dice a Laravel que modifique la columna existente
            $table->string('nombre_cientifico')->nullable(false)->change();
            $table->text('descripcion')->nullable(false)->change();
            $table->string('imagen_url')->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('productos', function (Blueprint $table) {
            // Si hacemos un rollback, vuelve a permitir nulos
            $table->string('imagen_url')->nullable()->change();
            $table->text('descripcion')->nullable()->change();
            $table->string('nombre_cientifico')->nullable()->change();
        });
    }
};
