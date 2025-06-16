<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah pengguna sudah login DAN emailnya adalah email admin.
        if (Auth::check() && Auth::user()->email == 'erikxzc@gmail.com') {
            // Jika ya, izinkan untuk melanjutkan ke halaman yang dituju.
            return $next($request);
        }

        // Jika tidak, alihkan ke halaman lain (misalnya, dashboard pengguna biasa).
        return redirect('/user/home')->with('error', 'You do not have admin access.');
    }
}
