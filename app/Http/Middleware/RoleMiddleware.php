<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        foreach ($roles as $role) {
            if ($role === 'Admin' && $user->isAdmin()) {
                return $next($request);
            }
            if ($role === 'Operator' && $user->isOperator()) {
                return $next($request);
            }
            if ($role === 'Passenger' && $user->isPassenger()) {
                return $next($request);
            }
        }

        abort(403, 'Unauthorized action.');
    }
}