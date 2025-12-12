<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminSessionMock
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Cek apakah sesi otentikasi dummy ada
        if (session('auth_mock_role') !== 'admin') {
            // Jika sesi tidak ada atau bukan admin, arahkan ke halaman login
            return redirect()->route('login');
        }

        // Jika lolos pengecekan, lanjutkan ke route tujuan
        return $next($request);
    }
}