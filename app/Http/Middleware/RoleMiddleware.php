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
     * @param  string  $role
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        $user = Auth::user();

         // Cek apakah pengguna ada dan memiliki role yang diizinkan
         if (!$user || $user->role !== $role) {
            // Jika tidak, bisa redirect ke halaman yang sesuai atau return response 403
            return redirect('/')->withErrors(['msg' => 'Unauthorized access.']);
         }
         
        return $next($request);
    }
}
