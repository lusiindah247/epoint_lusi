<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;  // Pastikan kamu menggunakan 'User' dengan huruf besar
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginRegisterController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:250',
            'email' => 'required|email|max:250|unique:users',
            'password' => 'required|min:8|confirmed',
        ]);

        // Membuat pengguna baru
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'usertype' => 'admin',  // Pastikan kolom 'usertype' ada
        ]);

        // Melakukan login setelah registrasi
        $credentials = $request->only('email', 'password');
        Auth::attempt($credentials);
        $request->session()->regenerate();

        if ($request->user()->usertype == 'admin') {
            return redirect('admin/dashboard')->with('success', 'You have successfully registered & logged in!');
        }

        return redirect()->intended(route('dashboard'));
    }

    public function login()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        // Validasi kredensial login
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            // Jika login berhasil
            $request->session()->regenerate();

            if ($request->user()->usertype == 'admin') {
                return redirect('admin/dashboard')->with('success', 'You have successfully logged in!');
            }
            
            return redirect()->intended(route('dashboard'));
        }

        // Jika login gagal
        return back()->withErrors([
            'email' => 'Your provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'You have logged out successfully!');
    }
}
