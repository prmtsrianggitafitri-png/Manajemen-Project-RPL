<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    public function create(): View
    {
        return view('auth.register');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nama'          => ['required', 'string', 'max:255'],
            'email'         => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
            'nim'           => ['required', 'string', 'max:20', 'unique:users,nim'],
            'jenis_kelamin' => ['required', 'in:laki-laki,perempuan'],
            'tahun_masuk'   => ['required', 'digits:4', 'integer', 'min:2000', 'max:'.date('Y')],
            'no_telepon'    => ['required', 'string', 'max:15'],
            'password'      => ['required', 'confirmed', 'min:8'],
        ]);

        User::create([
            'nim'           => $request->nim,
            'nama'          => $request->nama,
            'email'         => $request->email,
            'no_telepon'    => $request->no_telepon,
            'tahun_masuk'   => $request->tahun_masuk,
            'jenis_kelamin' => $request->jenis_kelamin,
            'password'      => Hash::make($request->password),
        ]);

        return redirect(route('login'))->with('success', 'Registrasi berhasil! Silakan masuk.');
    }
}