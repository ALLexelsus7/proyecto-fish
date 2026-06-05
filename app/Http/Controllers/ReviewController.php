<?php
// con 'php artisan make:controller ReviewController'
namespace App\Http\Controllers;

use App\Models\Review;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    // Funcion para guardar las reviews
    public function store(Request $request)
    {
        // Validar la entrada del cliente
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comentario' => 'required|string|min:10|max:1000',
        ], [
            'comentario.min' => 'Cuéntanos un poco más, el comentario debe tener al menos 10 caracteres.',
            'comentario.max' => '¡Tranquilo, marinero! El comentario no puede exceder los 1000 caracteres.'
        ]);

        // Crear la reseña asociada al usuario autenticado
        Review::create([
            'user_id' => Auth::id(),
            'rating' => $request->rating,
            'comentario' => $request->comentario,
        ]);

        // Redirecciona hacia atras
        return redirect()->back()->with('success_review', '¡Tu testimonio ha sido grabado en las profundidades con éxito!');
    }

    // Funcion para actualizar reviews
    public function update(Request $request, Review $review)
    {
        // Validar que el usuario sea el dueño
        if ($review->user_id !== Auth::id()) {
            abort(403, 'Acceso denegado: Esta bitácora no te pertenece.');
        }

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comentario' => 'required|string|min:10|max:1000',
        ]);

        $review->update([
            'rating' => $request->rating,
            'comentario' => $request->comentario,
        ]);

        return redirect()->back()->with('success_review', 'Tu testimonio ha sido recalibrado con éxito.');
    }

    // Funcion para eliminar reviews
    public function destroy(Review $review)
    {
        // Solo el dueño o el admin pueden borrar
        if ($review->user_id !== Auth::id() && !Auth::user()->is_admin) {
            abort(403, 'Acceso denegado.');
        }

        $review->delete(); // Esto aplica el SoftDelete

        return redirect()->back()->with('success_review', 'El testimonio ha sido borrado de los registros.');
    }

    // Ojo, no hay una funcion que redirija a la vista (los reviews estan debajo de contacto), 
    // entonces eso se hace desde el ContactoController.php
}
