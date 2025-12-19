<?php

namespace App\Http\Controllers;

// PASTIKAN MENGGUNAKAN INI (JANGAN GUNAKAN 'use App\Http\Controllers\Controller;')
use Illuminate\Routing\Controller; 
use Illuminate\Http\Request;

class LoginController extends Controller
{
    // Mock user credentials
    private $users = [
        'adminlp3i' => ['password' => 'akademiklp3i', 'role' => 'admin', 'name' => 'Admin Utama'],
        // Tambahkan user lain jika perlu
    ];

    public function showLoginForm()
    {
        // Jika sudah login, redirect ke dashboard
        if (session('auth_mock_role')) {
            return redirect()->route('admin.dashboard'); 
        }
        return view('auth.login'); 
    }

    public function login(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');

        if (isset($this->users[$username]) && $this->users[$username]['password'] === $password) {
            // Berhasil login Mockup: Simpan di session
            session([
                'auth_mock_role' => $this->users[$username]['role'],
                'auth_mock_name' => $this->users[$username]['name'],
            ]);

            // Redirect ke Dashboard Admin
            return redirect()->intended(route('admin.dashboard')); 
        }

        // Gagal login: Kirim error ke view
        return redirect()->route('login')->withErrors([
            'login_fail' => 'Username atau password salah.',
        ])->withInput($request->only('username'));
    }

    public function logout()
    {
        session()->forget(['auth_mock_role', 'auth_mock_name']);
        return redirect()->route('login')->with('success', 'Anda telah logout.');
    }
}