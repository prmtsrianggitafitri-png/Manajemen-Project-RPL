<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    // Tampilkan halaman login
    public function showLoginForm()
    {
        return view('auth.admin-login');
    }

    // Proses login
    public function login(Request $request)
    {
        $request->validate([
            'npsn'     => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        $credentials = [
            'NPSN'     => $request->npsn,
            'password' => $request->password,
        ];

        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('admin.dashboard'));
        }

        return back()->withErrors([
            'npsn' => 'NPSN atau password yang Anda masukkan tidak tepat.',
        ])->onlyInput('npsn');
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }
}