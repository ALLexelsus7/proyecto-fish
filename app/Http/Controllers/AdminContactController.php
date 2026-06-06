<?php
// con 'php artisan make:controller AdminContactController'
// para gestionar los mensajes de contacto
namespace App\Http\Controllers;

use App\Models\ContactMessage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminContactController extends Controller
{
    // Muestra la vista de mensajes de contacto
    public function index()
    {
        // Trae los mensajes ordenados por fecha de creación (los más nuevos primero)
        $mensajes = ContactMessage::latest()->paginate(10);
        return view('admin.mensajes.index', compact('mensajes'));
    }

    // Funcion para cambiar a "leido"
    public function toggleLeido(ContactMessage $mensaje)
    {
        // Cambia el estado (si era true pasa a false, y viceversa)
        $mensaje->update(['leido' => !$mensaje->leido]);
        return redirect()->back()->with('success', 'El estatus de la transmisión ha sido actualizado.');
    }

    // Funcion para eliminar un mensaje de contacto
    public function destroy(ContactMessage $mensaje)
    {
        $mensaje->delete();
        return redirect()->back()->with('success', 'Transmisión purgada de los registros.');
    }
}
