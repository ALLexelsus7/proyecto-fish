<?php
// Se creo automaticamente con Breeze
namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        // Manejo del Avatar
        if ($request->hasFile('avatar')) {
            // Borra el avatar viejo de la carpeta fisica si existe (para no acumular basura)
            if ($request->user()->avatar && file_exists(public_path('img/avatars/' . $request->user()->avatar))) {
                unlink(public_path('img/avatars/' . $request->user()->avatar));
            }

            // Generar un nombre unico
            $imageName = time() . '_' . uniqid() . '.' . $request->file('avatar')->extension();
            
            // Lo mueve a la carpeta publica
            $request->file('avatar')->move(public_path('img/avatars'), $imageName);
            
            // Guardar SOLO el nombre en la base de datos
            $request->user()->avatar = $imageName;
        }

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();
        /* "Elimina" el usuario (solo marca deleted_at y se deshabilita)
        Ojo, si se usa forceDelete() si se borra realmente.
        Se podria restaurar con
        User::withTrashed()->get() 
        User::onlyTrashed()->get()
        $user->restore() */

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}

// Ejecuto 'php artisan storage:link' para que la imagenes sean publicas.