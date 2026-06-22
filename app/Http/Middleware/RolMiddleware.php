<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RolMiddleware
{
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        if (!Auth::check()) {
            abort(403);
        }

        // Flatten comma-separated roles (e.g., rol:administrador,trabajador)
        $allowedRoles = collect($roles)
            ->flatMap(fn($r) => explode(',', $r))
            ->map(fn($r) => trim($r))
            ->toArray();

        foreach ($allowedRoles as $rol) {
            if (Auth::user()->rol === $rol) {
                return $next($request);
            }
        }

        abort(403);
    }
}
