<?php
// Con "php artisan make:controller ProductoController"
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Producto;

class ProductoController extends Controller
{
    // Muestra el catalogo publico
    public function index()
    {     
        // Se traen todos los productos indexados en MySQL
        $productos = Producto::all(); 
        // Mas adelante filtros o paginacion

        // Se retorna la vista + los datos con compact
        return view('productos', compact('productos'));
    }
}
