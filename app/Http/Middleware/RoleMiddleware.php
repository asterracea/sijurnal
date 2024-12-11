<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role): Response
    {
        // Cek apakah pengguna terautentikasi
        if (!auth()->check()) {
            return redirect('/login')->withErrors("You must be logged in.");
        }

        // Cek apakah role pengguna sesuai
        if (Auth::user()->role !== $role) {
            // Redirect kembali ke halaman sebelumnya
            return redirect()->back()->with('error', 'You do not have permission to access this page.');
        }
        $response = $next($request);
        $response->headers->set('Cache-Control', 'nocache, no-store, must-revalidate');
        $response->headers->set('Pragma', 'no-cache');
        $response->headers->set('Expires', '0');

        
        return $response;
    }
    
}
