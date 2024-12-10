<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle(Request $request, Closure $next, string $role)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if (Auth::user()->role !== $role) {
            $redirectRoute = Auth::user()->role === 'admin' ? 'admin.dashboard' : 'user.dashboard';
            return redirect()->route($redirectRoute)->with('error', 'Akses ditolak!');
        }

        return $next($request);
    }
}