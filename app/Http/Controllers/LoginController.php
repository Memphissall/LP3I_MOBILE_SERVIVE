<?php

namespace App\Http\Controllers;

// PASTIKAN MENGGUNAKAN INI (JANGAN GUNAKAN 'use App\Http\Controllers\Controller;')
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
        // Validasi input
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('username', 'password');

        // Coba login menggunakan Auth facade
        if (Auth::attempt($credentials, $request->has('remember'))) {
            // Regenerate session untuk keamanan
            $request->session()->regenerate();

            // Set session user data supaya kompatibel dengan view yang ada (optional)
            session([
                'user_role' => Auth::user()->role,
                'user_name' => Auth::user()->name,
            ]);

            // Redirect ke Dashboard Admin
            return redirect()->intended(route('admin.dashboard')); 
        }

        // Gagal login: Kirim error ke view
        return back()->withErrors([
            'login_fail' => 'Username atau password salah.',
        ])->withInput($request->only('username'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('login')->with('success', 'Anda telah logout.');
    }
}