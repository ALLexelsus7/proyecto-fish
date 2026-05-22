<?php
// Con "php artisan make:model Pedido -m" para modelo + migracion
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['user_id', 'total', 'estado',])]
class Pedido extends Model
{
    use HasFactory;

    protected $table = 'pedidos';

    // Relacion de un pedido pertenece a un usuario
    public function user() {
        return $this->belongsTo(User::class);
    }

    // Relacion de un pedido tiene muchos detalles del pedido
    public function detalles() {
        return $this->hasMany(DetallePedido::class);
    }
}
