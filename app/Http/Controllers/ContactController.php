<?php
// con 'php artisan make:controller ContactController'
// para manejar la logica de envio de correo
namespace App\Http\Controllers;

use App\Models\ContactMessage;
use App\Models\Review;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    // Muestra la vista de contacto y carga las reseñas (estan abajo)
    public function index()
    {
        $reviews = Review::with('user')->latest()->get();
        
        return view('contacto', compact('reviews'));
    }

    // Funcion para guardar un nuevo mensaje de contacto
    public function store(Request $request)
    {
        // Validar que no manden datos basura
        $request->validate([
            'nombre' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'asunto' => 'required|string|max:150',
            'mensaje' => 'required|string|min:10|max:2000',
        ], [
            'mensaje.min' => 'Tu transmisión es muy corta. Detalla un poco más tu solicitud.',
            'mensaje.max' => 'Tu transmisión es muy extensa. Se un poco más breve con tu solicitud.',
        ]);

        // Guardar en la base de datos
        ContactMessage::create([
            'nombre' => $request->nombre,
            'email' => $request->email,
            'asunto' => $request->asunto,
            'mensaje' => $request->mensaje,
        ]);

        return redirect()->back()->with('success_contact', '¡Transmisión enviada al Cuartel General! Nuestro equipo de sonar la ha recibido y te contactaremos pronto.');
    }
}
