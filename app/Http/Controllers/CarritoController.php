<?php
// con "php artisan make:controller CarritoController"
namespace App\Http\Controllers;

use App\Models\Carrito;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CarritoController extends Controller
{
    public function store(Request $request)
    {
        // Validacion que los datos que llegan de Axios sean correctos
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
}
