<?php
// con "php artisan make:controller PedidoController"
// Aqui se usa la transacion de base de datos DB::beginTransaction para cumplir
// con la regla ACID de terminar todos los pasos sin error, sino, no se guarda nada.
namespace App\Http\Controllers;

use App\Models\Carrito;
use App\Models\Pedido;
use App\Models\DetallePedido;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PedidoController extends Controller
{
    // Funcion para procesar el pedido 
    public function procesarCheckout()
    {
        $userId = Auth::id();
        
        // Se obtiene el carrito del usuario
        $itemsCarrito = Carrito::with('producto')->where('user_id', $userId)->get();

        // Valida que no este vacio el carrito
        if ($itemsCarrito->isEmpty()) {
            return response()->json(['status' => 'error', 'message' => 'Tu red de captura está vacía.'], 400);
        }

        // (●'◡'●) INICIA LA TRANSACCIÓN SEGURA
        DB::beginTransaction();

        try {
            // Calcula el total a cobrar
            $totalCobrar = $itemsCarrito->sum(function ($item) {
                return $item->cantidad * $item->producto->precio;
            });

            // Crea la Cabecera de la Factura (Tabla pedidos)
            $pedido = Pedido::create([
                'user_id' => $userId,
                'total' => $totalCobrar,
                'estado' => 'pendiente', // Listo para que el admin lo revise
            ]);

            // Congela los Detalles (Tabla detalles_pedido) y resta del Stock
            foreach ($itemsCarrito as $item) {
                DetallePedido::create([
                    'pedido_id' => $pedido->id,
                    'producto_id' => $item->producto_id,
                    'cantidad' => $item->cantidad,
                    'precio_unitario' => $item->producto->precio, // Precio congelado
                    'tipo_compra' => $item->tipo_compra,
                ]);

                // Descontamos el stock de la tabla productos
                if ($item->producto) {
                    $item->producto->decrement('stock', $item->cantidad);
                }
            }

            // Aqui se vacia el carrito de la base de datos para que se pueda llenar de nuevo
            Carrito::where('user_id', $userId)->delete();

            // (●'◡'●) Si no hubo ningun error interno/externo, se confirman los cambios en MYSQL 
            DB::commit();

            // Se redirige a la vista de chekout para descargar su recibo
            return response()->json([
                'status' => 'success',
                'message' => '¡Adquisición exitosa! Tu pedido #' . $pedido->id . ' está en la bitácora.',
                'redirect_url' => route('checkout.success', ['id' => $pedido->id])
            ]);

        } catch (\Exception $e) {
            // SI ALGO FALLA, SE DESHACEN TODOS LOS CAMBIOS (Rollback)
            DB::rollBack();
            return response()->json([
                'status' => 'error', 
                'message' => 'Anomalia detectada. La transaccion ha sido cancelada.',
                'error_tecnico' => $e->getMessage(), // Habilite estas opciones para solucionar errores con debbugging
                'linea_del_error' => $e->getLine()   // en opc. de desarrollador de la web -> network -> output
            ], 500);
        }
    }

    // Verificacion y redireccion a la vista despues de procesarCheckout()
    public function success($id)
    {
        // Buscamos el pedido y nos aseguramos de que pertenezca al usuario logueado
        $pedido = Pedido::with(['detalles.producto', 'user'])
                    ->where('user_id', Auth::id())
                    ->findOrFail($id);

        return view('checkout.success', compact('pedido'));
    }
}