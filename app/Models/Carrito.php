<?php
// Con "php artisan make:model Carrito -m" para el modelo y la migracion
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['user_id', 'producto_id', 'cantidad', 'tipo_compra',])]
class Carrito extends Model
{
    use HasFactory;

    protected $table = 'carritos';

    // Relacion: Este item del carrito pertenece a un Usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relacion: Este item del carrito corresponde a un Producto
    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
}
