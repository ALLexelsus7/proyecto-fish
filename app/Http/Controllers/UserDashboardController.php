<?php
// con "php artisan make:controller UserDashboardController"
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pedido;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Pedidos del usuario autenticado (nuevo a viejo)
        $pedidos = Pedido::with('detalles.producto')
                        ->where('user_id', $user->id)
                        ->orderBy('created_at', 'desc')
                        ->get();

        // Favoritos
        $favoritos = $user->favoritos()->get();

        return view('dashboard', compact('pedidos', 'favoritos'));
    }
}
