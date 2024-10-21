<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        // Cek apakah pengguna terautentikasi
        if (!auth()->check()) {
            return redirect('/login')->withErrors("You must be logged in.");
        }

        // Cek apakah role pengguna sesuai
        if (auth()->user()->role === $role) {
            return $next($request);
        }

        // Redirect ke URL sesuai role jika tidak sesuai
        Auth::logout(); // Logout pengguna
        return redirect('/login')->withErrors("Access denied due to invalid role.");
    }
}
