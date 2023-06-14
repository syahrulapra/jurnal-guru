<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        foreach ($roles as $role) {
            if ($user->role == $role) {
                return $next($request);
            }
        }

        if ($user->role == 'Admin') {
            return to_route('admin');
        } elseif ($user->role == 'Guru') {
            return to_route('guru');
        } else {
            return response()->json([
                'Error'
            ]);
        }
    }
}