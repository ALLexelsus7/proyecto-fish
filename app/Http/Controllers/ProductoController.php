<?php
// Con "php artisan make:controller ProductoController"
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Producto;

class ProductoController extends Controller
{
    // Muestra el catalogo de productos para los clientes (Con Filtros y Paginación)
    public function index(Request $request)
    {
        // Consulta base de Eloquent
        $query = Producto::query();
        //sin Producto::all(); para no cargar todo el conjunto de golpe

        // Extrae los favoritos del usuario logeado y guarda los IDs en un array nativo
        $favoritosUser = [];
        if (auth()->check()) {            
            $favoritosUser = auth()->user()->favoritos()->pluck('producto_id')->toArray();
        }

        // Filtro para mostrar solo Favoritos (si los hay)
        if ($request->filled('solo_favoritos')) {
            // Se restringe la consulta de MySQL
            $query->whereIn('id', $favoritosUser);
        }

        // Filtro de Búsqueda por Texto (Nombre común, científico o descripción)
        // mediante coincidencias parciales %...%
        if ($request->filled('search')) {
            $searchTerm = '%' . $request->search . '%';
            $query->where(function($q) use ($searchTerm) {
                $q->where('nombre_comun', 'LIKE', $searchTerm)
                  ->orWhere('nombre_cientifico', 'LIKE', $searchTerm)
                  ->orWhere('descripcion', 'LIKE', $searchTerm);
            });
        }

        // Filtro por Categoría (zona de profundidad)
        if ($request->filled('categoria')) {
            $query->where('categoria', $request->categoria);
        }

        // Filtro por Estado de Vida
        if ($request->filled('estado_vida')) {
            $query->where('estado_vida', $request->estado_vida);
        }

        // Filtro por Rango de Precios
        if ($request->filled('precio_min')) {
            $query->where('precio', '>=', $request->precio_min);
        }
        if ($request->filled('precio_max')) {
            $query->where('precio', '<=', $request->precio_max);
        }

        // Ejecución y Paginación Estricta (withQueryString conserva los filtros al cambiar de página)
        $productos = $query->paginate(12)->withQueryString();

        //Retorna productos con filtros y los favoritos para ser marcados
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
    // Funcion de Almacenar el producto nuevo
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

    // Vista de Editar producto (manda los datos del producto)
    public function edit(Producto $producto)
    {
        return view('admin.productos.edit', compact('producto'));
    }
    // Funcion de actualizar producto
    public function update(Request $request, $id)
    {
        // Localiza el producto especifico
        $producto = Producto::findOrFail($id);

        // Valida los datos entrantes
        $request->validate([
            'nombre_comun'      => 'required|string|max:255',
            'nombre_cientifico' => 'required|string|max:255',
            'categoria'         => 'required|in:shallow_coastal,oceanic,hadal_zone',
            'estado_vida'       => 'required|in:ambos,vivo,consumo',
            'precio'            => 'required|numeric|min:0',
            'stock'             => 'required|integer|min:0',
            'descripcion'       => 'required|string',
            'imagen_url'        => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048', 
            // nullable por ser opcional
        ]);

        // Extrae los datos validados EXCEPTO la imagen
        $data = $request->except(['imagen_url', '_token', '_method']);

        // Procesa la imagen si se subio una nueva
        if ($request->hasFile('imagen_url')) {
            $file = $request->file('imagen_url');            
            // Genera un nombre unico para evitar colisiones
            $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();            
            //Mueve el archivo a la ruta
            $file->move(public_path('img/fish'), $fileName);            
            // Adjunta el nuevo nombre al paquete de datos a guardar
            $data['imagen_url'] = $fileName;
            // Destruye la imagen vieja para no saturar el servidor
            $rutaImagenVieja = public_path('img/fish/' . $producto->imagen_url);
            if ($producto->imagen_url && file_exists($rutaImagenVieja)) {
                // Evitamos borrar las imágenes "semilla" por defecto
                if (!str_starts_with($producto->imagen_url, 'fish')) {
                    unlink($rutaImagenVieja);
                }
            }
        }

        // Se actualiza
        $producto->update($data);

        return redirect()->route('admin.productos.index')
                         ->with('success', '¡Los datos de la criatura han sido actualizados con éxito!');
    }

    // Funcion de Eliminar producto
    public function destroy(Producto $producto)
    {
        // Destruye la imagen física del servidor
        $rutaImagen = public_path('img/fish/' . $producto->imagen_url);        
        // Verifica que la imagen exista y protegemos las imágenes "semilla" (fish1.png, etc.)
        if ($producto->imagen_url && file_exists($rutaImagen)) {
            if (!str_starts_with($producto->imagen_url, 'fish')) {
                unlink($rutaImagen);
            }
        }

        // "Elimina" el producto (solo marca deleted_at y se deshabilita). Igual para users.
        $producto->delete();
        /* Ojo, se podria restaurar con
        User::withTrashed()->get() o Producto::withTrashed()->get()
        User::onlyTrashed()->get()
        $user->restore()
        */
        // Ojo, si se usa forceDelete() si se borra realmente

        return redirect()->route('admin.productos.index')
                         ->with('success', '¡La especie ha sido eliminada permanentemente del catálogo abisal!');
    }
}
