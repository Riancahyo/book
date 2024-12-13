<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Tambahkan ini
use Symfony\Component\HttpFoundation\Response;

class CheckAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, $role = null)
    {
        if (Auth::check()) {
            // Memeriksa role jika diberikan sebagai parameter
            if ($role && Auth::user()->role !== $role) {
                return redirect('/'); // Redir ke halaman tertentu jika role tidak sesuai
            }
            return $next($request);
        }

        // Jika user belum login
        return redirect('/login');
    }
}
