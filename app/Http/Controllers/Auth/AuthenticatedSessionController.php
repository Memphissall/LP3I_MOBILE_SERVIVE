<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionControlle extends Controller
{
    /**
     * Tampilkan halaman login
     */
    public function create(): View
    {
        return view('auth.login');
    }

    //OLD
    /**
     * Handle login request
     */
    // public function store(LoginRequest $request): RedirectResponse
    // {
    //     $request->authenticate(); // login user
    //     $request->session()->regenerate();

    //     $user = Auth::user(); // user sudah login

    //     if ($user->role === 'admin') {
    //         return redirect('/dashboard'); // admin ke register
    //     } else {
    //         return redirect('/dashboard'); // user biasa ke dashboard
    //     }
    // }

    //NEW
    public function store(LoginRequest $request): RedirectResponse
{
    $request->authenticate();
    $request->session()->regenerate();

    $user = Auth::user();

    if ($user->role === 'admin') {
        return redirect()->route('admin.dashboard'); 
    }

    return redirect()->route('user.dashboard'); 
}


    /**
     * Logout
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
