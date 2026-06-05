<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Producto;
use App\Models\Review;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //Inyecta 10 usuarios de prueba
        User::factory()->count(10)->create();

        // Crea un admin de prueba
        User::factory()->create([
            'name' => 'Alexelsus',
            'email' => 'admin@abyssal.com',
            'password' => Hash::make('password123'), // Encriptada
            'rol' => 'admin',
        ]);

        // Crea un cliente de prueba
        User::factory()->create([
            'name' => 'Cliente',
            'email' => 'cliente@abyssal.com',
            'password' => Hash::make('password123'),
            'rol' => 'cliente',
        ]);

        // Inyecta 15 criaturas con el factory de producto
        Producto::factory()->count(15)->create();    

        // Inyecta 7 resenias
        Review::factory()->count(7)->create();
    }
}

// Ejecuto "php artisan migrate:fresh --seed" para hacer las migraciones limpiando todo y 
// a la vez ejecutar los seeders y factories de DatabaseSeeder.php

// Para ejecutar solo el databaseseeder 'php artisan db:seed'
// Para ejecutar un solo un seeder o factory 'php artisan db:seed --class=UserSeeder'