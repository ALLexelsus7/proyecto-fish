<?php
// Con "php artisan make:model Producto -m" se creo el Modelo y (-m) migracion de Productos
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // para que el producto no se elimine

// Aqui agrego los campos asignables masivamente
#[Fillable(['nombre_comun', 'nombre_cientifico', 'categoria', 'precio', 'stock', 'descripcion', 'imagen_url', 'estado_vida',])]
class Producto extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'productos';

    public function deseadoPorUsuarios()
    {
        return $this->belongsToMany(User::class, 'favoritos', 'producto_id', 'user_id')->withTimestamps();
    }

}
