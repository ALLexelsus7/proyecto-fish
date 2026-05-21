<?php
// Cree el factory con "php artisan make:factory ProductoFactory --model=Producto"
// Y se usara para poblar de datos random la tabla de productos
namespace Database\Factories;

use App\Models\Producto;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductoFactory extends Factory
{
    protected $model = Producto::class;

    public function definition(): array
    {
        // Lista temática
        $pecesAbisales = [
            ['comun' => 'Rape Abisal', 'cientifico' => 'Melanocetus johnsonii'],
            ['comun' => 'Pez Linterna', 'cientifico' => 'Centrophryne spinulosa'],
            ['comun' => 'Pez Dragón Negro', 'cientifico' => 'Idiacanthus atlanticus'],
            ['comun' => 'Tiburón Duende', 'cientifico' => 'Mitsukurina owstoni'],
            ['comun' => 'Engullidor Negro', 'cientifico' => 'Chiasmodon niger'],
            ['comun' => 'Pez Quimera', 'cientifico' => 'Chimaera monstrosa'],
            ['comun' => 'Pulpo Dumbo', 'cientifico' => 'Grimpoteuthis'],
            ['comun' => 'Isópodo Gigante', 'cientifico' => 'Bathynomus giganteus'],
            ['comun' => 'Pez Trípode', 'cientifico' => 'Bathypterois grallator'],
            ['comun' => 'Calamar Vampiro', 'cientifico' => 'Vampyroteuthis infernalis']
        ];

        // Seleccion de pez aleatorio de la lista
        $pezAleatorio = $this->faker->randomElement($pecesAbisales);

        return [
            'nombre_comun' => $pezAleatorio['comun'],
            'nombre_cientifico' => $pezAleatorio['cientifico'],        
            'categoria' => $this->faker->randomElement(['shallow_coastal', 'oceanic', 'hadal_zone']),     
            'precio' => $this->faker->randomFloat(2, 450, 7500),  
            'stock' => $this->faker->numberBetween(1, 12),          
            'descripcion' => 'Una de las criaturas más esquivas del océano profundo. ' . $this->faker->paragraph(1),         
            'imagen_url' => 'img/fish/fish' . $this->faker->numberBetween(1, 12) . '.png',        
            'estado_vida' => $this->faker->randomElement(['ambos', 'vivo', 'consumo']),
        ];
    }
}

// Lo ejecuto con "php artisan migrate:fresh --seed" desde DatabaseSeeder.php