<?php
// Con "php artisan make:model Producto -m" se creo el Modelo y (-m) migracion de Productos
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

// Aqui agrego los campos asignables masivamente
#[Fillable(['nombre_comun', 'nombre_cientifico', 'categoria', 'precio', 'stock', 'descripcion', 'imagen_url', 'estado_vida',])]
class Producto extends Model
{
    use HasFactory;

}
