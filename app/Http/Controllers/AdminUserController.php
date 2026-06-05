<?php
// con 'php artisan make:controller AdminUserController'
// para gestionar a los usuarios
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    // Vista para mostrar a los usuarios
    public function index()
    {
        // Traemos a todos los usuarios excepto al admin logueado, ordenados por los más recientes
        $usuarios = User::where('id', '!=', Auth::id())->latest()->paginate(10);
        
        return view('admin.usuarios.index', compact('usuarios'));
    }

    // Funcion para eliminar usuarios
    public function destroy(User $user)
    {
        // Si intentan borrar a otro admin por seguridad (opcional, dependiendo de tu lógica)
        if ($user->rol === 'admin') {
            return redirect()->back()->with('error', 'No puedes revocar el acceso a otro oficial de rango Admin.');
        }

        // SoftDelete: El usuario ya no podrá loguearse, pero sus pedidos y reseñas quedan intactos
        $user->delete();

        return redirect()->back()->with('success', 'El explorador ha sido exiliado del Abismo exitosamente.');
    }

    // Funcion para actualizar el rol de usuario
    public function updateRole(Request $request, User $user)
    {
        // Validación de seguridad: No puedes cambiarte el rango a ti mismo
        if ($user->id === Auth::id()) {
            return redirect()->back()->with('error', 'No puedes alterar tu propio rango táctico.');
        }

        $request->validate([
            'rol' => 'required|in:admin,cliente'
        ]);

        $user->update(['rol' => $request->rol]);

        return redirect()->back()->with('success', "El rango del explorador {$user->name} ha sido actualizado a " . strtoupper($request->rol) . ".");
    }
}
