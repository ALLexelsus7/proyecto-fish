<?php
// con "php artisan make:controller FavoritoController"
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoritoController extends Controller
{
    public function toggle(Request $request, $id)
    {
        $user = Auth::user();
        $producto = Producto::findOrFail($id);

        // toggle() añade el ID si no existe, o lo remueve si ya existe en la tabla pivote.
        $resultado = $user->favoritos()->toggle($producto->id);

        // Averiguamos si al final quedó adjuntado o removido para avisar al frontend
        $esFavorito = in_array($producto->id, $resultado['attached']);

        return response()->json([
            'status' => 'success',
            'es_favorito' => $esFavorito,
            'message' => $esFavorito ? 'Especie fijada en el radar.' : 'Especie removida del radar.'
        ]);
    }
}
