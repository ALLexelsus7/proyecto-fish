<?php
// con 'php artisan make:model Review -mf' para hacer el modelo, migracion y factory
namespace Database\Factories;

use App\Models\Review;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends Factory<Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // Toma un usuario aleatorio de la base de datos, si no lo hay, lo crea con el rol cliente
            'user_id' => User::where('rol', 'cliente')->inRandomOrder()->first()?->id ?? User::factory()->create(['rol' => 'cliente'])->id,
            'rating' => $this->faker->numberBetween(1, 5),
            'comentario' => $this->faker->paragraph(2),
        ];
    }
}
// 