<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Perbaiki penulisan Illuminate
use Symfony\Component\HttpFoundation\Response;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Periksa apakah pengguna sudah terautentikasi dan memiliki usertype 'admin'
        if (Auth::check() && Auth::user()->usertype != 'admin') {
            return redirect('dashboard');  // Pengguna tidak punya akses, arahkan ke dashboard
        }

        return $next($request);  // Lanjutkan permintaan jika valid
    }
}
