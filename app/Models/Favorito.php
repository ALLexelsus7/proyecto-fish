<?php
// con "php artisan make:model Favorito -m" para la migracion y modelo
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['user_id', 'producto_id',])]
class Favorito extends Model
{
    use HasFactory;

    protected $table = 'favoritos';

    // Relacion: Este item pertenece a un Usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relacion: Este item corresponde a un Producto
    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
}

// Ejecuto "php artisan migrate:fresh --seed" para rehacer las migraciones y seeders