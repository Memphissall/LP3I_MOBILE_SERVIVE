<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        // Jika sudah login, redirect ke dashboard
        if (Auth::check()) {
            return redirect()->route('admin.dashboard'); 
        }
        return view('auth.login'); 
    }

    public function login(Request $request)
    {
        // Validasi input - login pakai email
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        // Cek apakah akun active
        $user = \App\Models\User::where('email', $request->email)->first();
        
        if ($user && !$user->is_active) {
            return back()->withErrors([
                'login_fail' => 'Akun Anda tidak aktif. Hubungi admin.',
            ])->withInput($request->only('email'));
        }

        // Coba login menggunakan Auth facade
        if (Auth::attempt($credentials, $request->has('remember'))) {
            // Regenerate session untuk keamanan
            $request->session()->regenerate();

            // Set session user data supaya kompatibel dengan view yang ada
            session([
                'user_role' => Auth::user()->role,
                'user_name' => Auth::user()->name,
            ]);

            // Redirect ke Dashboard Admin
            return redirect()->intended(route('admin.dashboard')); 
        }

        // Gagal login: Kirim error ke view
        return back()->withErrors([
            'login_fail' => 'Email atau password salah.',
        ])->withInput($request->only('email'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('login')->with('success', 'Anda telah logout.');
    }
}