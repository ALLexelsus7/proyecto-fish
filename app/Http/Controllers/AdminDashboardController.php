<?php
// con "php artisan make:controller AdminDashboardController"
/*Recuerda, un controlador es como un "director de orquesta" que maneja la lógica detrás de las vistas. 
  En este caso, el AdminDashboardController se encargará de recopilar y 
  procesar los datos necesarios para mostrar en el panel de administración.*/
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Pedido;
use Carbon\Carbon; // Carbon es una biblioteca de PHP para manejar fechas y horas de manera más sencilla.

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Estadísticas de Inventario
        $especiesEnBd = Producto::count();
        $stockTotal = Producto::sum('stock');
        $sinStock = Producto::where('stock', '<=', 0)->count();
        // Estadísticas de Logística y Ventas
        $pedidosPendientes = Pedido::where('estado', 'pendiente')->count();        
        $ingresosMes = Pedido::whereMonth('created_at', Carbon::now()->month)
                             ->whereYear('created_at', Carbon::now()->year)
                             ->sum('total');

        // Monitor de pedidos
        $pedidos = Pedido::with('user')->latest()->take(10)->get(); // Trae los ultimos 10 con los datos del usuario que lo creo       
        $totalVentas = Pedido::where('estado', '!=', 'cancelado')->sum('total'); // Suma el total de ventas (excluyendo cancelados)

        /* Recuerda: aqui se retorna la vista del dashboard admin con las variables 
           necesarias para mostrar las estadísticas.*/
        return view('admin.dashboard', compact(
            'especiesEnBd', 
            'stockTotal', 
            'sinStock', 
            'pedidosPendientes',
            'ingresosMes',
            'pedidos',
            'totalVentas'
        ));
    }

    // Validacion y actualizacion del estatus del pedido (para el dropdown del monitor de pedidos)
    public function updateEstatus(Request $request, Pedido $pedido)
    {
        // Valida con el Enum de estados permitidos
        $request->validate([
            'estatus' => 'required|in:pendiente,enviado,entregado,cancelado'
        ]);

        // Actualiza el estado
        $pedido->estado = $request->estatus;
        $pedido->save();

        return response()->json([
            'success' => true, 
            'message' => 'Estatus actualizado correctamente.'
        ]);
    }

    // Mostrar los detalles del pedido
    public function getDetalles(Pedido $pedido)
    {
        // Cargamos el usuario y los detalles, y de cada detalle cargamos SU producto relacionado
        $pedido->load(['user', 'detalles.producto']);
        
        return response()->json($pedido);
    }
}
