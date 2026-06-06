<?php

namespace Database\Factories;

use App\Models\ContactMessage;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ContactMessage>
 */
class ContactMessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => fake()->name(),
            'email' => fake()->safeEmail(),
            'asunto' => fake()->sentence(4),
            'mensaje' => fake()->paragraph(3),
            'leido' => fake()->boolean(20), // El 20% se crean ya leidos
        ];
    }
}
// Para ejecutar solo este factory entro a php artisan tinker
// y pongo 'App\Models\ContactMessage::factory()->count(15)->create();'
// luego 'exit'