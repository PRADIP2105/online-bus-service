<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!Auth::check() || !in_array(Auth::user()->role_id, array_map('intval', explode('|', implode('|', $roles))))) 
        {
            // abort(403, 'Unauthorized action.')
        }

        return $next($request);
    }
}