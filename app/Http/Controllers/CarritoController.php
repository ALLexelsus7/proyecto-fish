<?php
// con "php artisan make:controller CarritoController"
namespace App\Http\Controllers;

use App\Models\Carrito;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CarritoController extends Controller
{
    /**
     * Agrega los productos al carrito del usuario con AXIOS
     */
    public function store(Request $request)
    {
        // Validacion que los datos que llegan sean correctos
        $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'tipo_compra' => 'required|in:consumo,ornamental',
        ]);

        // Se busca si ya existe ese pez con este tipo de compra en el carrito del usuario
        $itemExistente = Carrito::where('user_id', Auth::id())
                                ->where('producto_id', $request->producto_id)
                                ->where('tipo_compra', $request->tipo_compra)
                                ->first();

        if ($itemExistente) {
            // se suma 1 a la cantidad
            $itemExistente->increment('cantidad');
        } else {
            // se crea desde cero
            Carrito::create([
                'user_id' => Auth::id(),
                'producto_id' => $request->producto_id,
                'cantidad' => 1,
                'tipo_compra' => $request->tipo_compra,
            ]);
        }

        // Se devuelve una respuesta JSON de exito a Axios
        return response()->json([
            'status' => 'success',
            'message' => 'Criatura añadida a la red de captura.'
        ]);
    }

    /**
     * Devuelve los datos del carrito en formato JSON para Alpine.js
     * Para reflejarlo en la UI del carrito lateral.
     */
    public function getCarrito()
    {
        // Traemos el carrito del usuario logueado INCLUYENDO los datos del producto (Eager Loading)
        $items = Carrito::with('producto')
                        ->where('user_id', Auth::id())
                        ->get();

        // Mapeamos los datos para mandarlos listos y limpios al frontend
        $carritoFormateado = $items->map(function($item) {
            return [
                'carrito_id' => $item->id, // El ID de la fila en el carrito (para poder borrarlo)
                'producto_id' => $item->producto_id,
                'nombre' => $item->producto->nombre_comun,
                'imagen' => asset($item->producto->imagen_url ?? 'img/fish/fish1.png'),
                'tipo_compra' => $item->tipo_compra,
                'cantidad' => $item->cantidad,
                'precio' => $item->producto->precio,
                'precio_formateado' => number_format($item->producto->precio, 2)
            ];
        });

        // Calculamos el gran total matemático
        $total = $items->sum(function($item) {
            return $item->cantidad * $item->producto->precio;
        });

        return response()->json([
            'items' => $carritoFormateado,
            'total_formateado' => number_format($total, 2)
        ]);
    }

    /**
     * Incrementa o decrementa la cantidad de un ítem en el carrito
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'accion' => 'required|in:incrementar,decrementar'
        ]);

        $item = Carrito::where('user_id', Auth::id())->where('id', $id)->first();

        if ($item) {
            if ($request->accion === 'incrementar') {
                $item->increment('cantidad');
            } elseif ($request->accion === 'decrementar') {
                if ($item->cantidad > 1) {
                    $item->decrement('cantidad');
                } else {
                    // Si la cantidad es 1 y presionan "-", lo liberamos automáticamente de la base de datos
                    $item->delete();
                }
            }
            return response()->json(['status' => 'success']);
        }

        return response()->json(['status' => 'error', 'message' => 'No encontrado'], 404);
    }

    /**
     * Elimina un ítem específico del carrito
     */
    public function destroy($id)
    {
        // Buscamos el ítem asegurándonos de que pertenezca al usuario actual por seguridad
        $item = Carrito::where('user_id', Auth::id())->where('id', $id)->first();
        
        if ($item) {
            $item->delete();
            return response()->json(['status' => 'success', 'message' => 'Criatura liberada.']);
        }

        return response()->json(['status' => 'error'], 404);
    }

}
