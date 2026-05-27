<?php
// con "php artisan make:middleware CheckAdmin"
// Verifica si el usuario es admin para entrar a las rutas admin
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Verifica que este logueado y que su rol sea de admin
        if (Auth::check() && Auth::user()->rol === 'admin') {            
            return $next($request);
        }

        // Si no se manda error 403 (Acceso Denegado) o se redirige a su home.
        return redirect()->route('home')->with('error', 'Acceso denegado: Rango insuficiente para esta zona.');
    }
}
