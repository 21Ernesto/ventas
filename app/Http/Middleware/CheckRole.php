<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle($request, Closure $next, ...$roles)
    {
        // Verifica si el usuario tiene al menos uno de los roles especificados
        foreach ($roles as $role) {
            if ($request->user() && $request->user()->role === $role) {
                return $next($request);
            }
        }

        abort(403, 'Acceso no autorizado.');
    }
}
