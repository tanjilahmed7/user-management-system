<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{

    public function handle($request, Closure $next, $permission)
    {
        $user = auth()->user();

        if ($user->isAdmin()) {
            return $next($request);
        } else if (!$user->permissions()->where('name', $permission)->exists()) {
            abort(403, 'Unauthorized');
        }
        return $next($request);

    }

}
