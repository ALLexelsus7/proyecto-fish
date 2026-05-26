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
        // Se traen todos los productos activos indexados en MySQL
        $productos = Producto::all();
        $favoritosUser = [];
        // Si el usuario esta logeado, extraemos SOLO los IDs de sus favoritos
        if (auth()->check()) {
            $favoritosUser = auth()->user()->favoritos()->pluck('producto_id')->toArray();
        }
        // Mas adelante filtros o paginacion

        // Se retorna la vista + los datos con compact
        return view('productos', compact('productos', 'favoritosUser'));
    }

    // Muestra el catalogo para el admin
    public function adminIndex()
    {
        // Se traen los productos ordenador por menor stock y paginados
        $productos = Producto::orderBy('stock', 'asc')->paginate(5);

        return view('admin.productos.index', compact('productos'));
    }

    // Actualiza el inventario rápidamente mediante una petición AJAX
    public function updateStock(Request $request, Producto $producto)
    {
        $request->validate([
            'stock' => 'required|integer|min:0'
        ]);

        $producto->stock = $request->stock;
        $producto->save();

        return response()->json([
            'success' => true,
            'message' => 'Inventario sincronizado.',
            'stock_actual' => $producto->stock
        ]);
    }

    // Vista de crear nuevo producto
    public function create()
    {
        return view('admin.productos.create');
    }
    // Almacenar el producto nuevo
    public function store(Request $request)
    {
        // Valida los datos entrantes
        $request->validate([
            'nombre_comun'      => 'required|string|max:255',
            'nombre_cientifico' => 'required|string|max:255', 
            'categoria'         => 'required|in:shallow_coastal,oceanic,hadal_zone',
            'estado_vida'       => 'required|in:ambos,vivo,consumo',
            'precio'            => 'required|numeric|min:0',
            'stock'             => 'required|integer|min:0',
            'descripcion'       => 'required|string',
            'imagen_url'        => 'required|image|mimes:jpeg,png,jpg,webp|max:2048', // Max. 2MB
        ]);

        // Procesamiento de la imagen
        $imageName = null;
        if ($request->hasFile('imagen_url')) {
            // Genera un nombre único usando la fecha y la extensión original
            $imageName = time() . '_' . uniqid() . '.' . $request->imagen_url->extension();
            // Mueve el archivo a la carpeta física del proyecto
            $request->imagen_url->move(public_path('img/fish'), $imageName);
        }

        // Inserta en la Base de Datos
        $producto = new Producto();
        // Mapea los campos del formulario a las columnas de la BD
        $producto->nombre_comun = $request->nombre_comun; 
        $producto->nombre_cientifico = $request->nombre_cientifico; 
        $producto->categoria = $request->categoria;
        $producto->estado_vida = $request->estado_vida;
        $producto->precio = $request->precio;
        $producto->stock = $request->stock;
        $producto->descripcion = $request->descripcion;
        $producto->imagen_url = $imageName; // solo guarda el nombre del archivo
        $producto->save();

        // Redirige al inventario con un mensaje de éxito
        return redirect()->route('admin.productos.index')
                         ->with('success', 'Especie "' . $producto->nombre_comun . '" registrada exitosamente en el tanque.');
    }

    // Editar producto
    public function edit(Producto $producto)
    {
        return view('admin.productos.edit', compact('producto'));
    }

    // Eliminar producto
    public function destroy(Producto $producto)
    {
        $producto->delete();
        return response()->redirect(route('admin.productos.index'));
    }
}
