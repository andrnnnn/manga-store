<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ], [
            'email.required' => 'Eh, email-nya belum diisi nih >_<',
            'email.email' => 'Format email-nya belum benar nih...',
            'password.required' => 'Password-nya jangan lupa diisi ya! ^-^'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $redirectRoute = Auth::user()->role === 'admin' ? 'admin.dashboard' : 'user.dashboard';
            return redirect()->route($redirectRoute);
        }

        return back()->withErrors([
            'email' => 'Waduh, email atau password kamu salah nih... Coba cek lagi ya!'
        ]);
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'name.required' => 'Nama kamu belum diisi nih...',
            'name.max' => 'Waduh, nama kamu kepanjangan! Maksimal 255 karakter ya',
            'email.required' => 'Email-nya jangan lupa diisi ya!',
            'email.email' => 'Format email-nya belum benar nih...',
            'email.unique' => 'Email ini sudah dipakai nih, coba pakai email lain ya!',
            'password.required' => 'Password-nya masih kosong nih...',
            'password.min' => 'Password minimal 8 karakter ya!',
            'password.confirmed' => 'Konfirmasi password-nya belum cocok nih...'
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'user'
        ]);

        Auth::login($user);

        return redirect()->route('user.dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('success', 'Berhasil logout!');
    }
}
