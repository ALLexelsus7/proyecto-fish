<?php
// con 'php artisan make:model Review -mf' para hacer el modelo, migracion y factory
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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            // Relacion con el usuario (si se borra el usuario, se borran sus reseñas)
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->unsignedTinyInteger('rating'); // Valores del 1 al 5
            $table->text('comentario');
            $table->timestamps();
            $table->softDeletes(); // para que solo se desactive el review
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
// ejecuto la migracion con 'php artisan migrate'