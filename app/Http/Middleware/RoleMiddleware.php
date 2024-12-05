<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        if (Auth::user()->role() !== $role) {
            abort(403, 'Unauthorized');
        }
        return $next($request);

    }
}
