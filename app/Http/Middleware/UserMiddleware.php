<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->role == 1) {
            // Jika user sudah login dan memiliki role 1, lanjutkan ke halaman admin
            return redirect('app');
        } elseif (Auth::check() && Auth::user()->role == 2) {
            // Jika user sudah login dan memiliki role 2, lanjutkan ke halaman user
            return redirect('/');
        }
        return $next($request);
    }
}
