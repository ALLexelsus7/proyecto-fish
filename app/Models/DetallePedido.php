<?php
// Con "php artisan make:model DetallePedido -m" para modelo + migracion
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['pedido_id', 'producto_id', 'cantidad', 'precio_unitario', 'tipo_compra',])]
class DetallePedido extends Model
{
    use HasFactory;

    protected $table = 'detalle_pedidos';

    // Relacion de un detalle_pedidos pertenece a un pedido
    public function pedido() {
        return $this->belongsTo(Pedido::class);
    }

    // Relacion de un detalle_pedidos pertenece a un producto
    public function producto() {
        return $this->belongsTo(Producto::class);
    }
}
