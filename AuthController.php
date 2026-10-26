<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');

        // Logika sederhana: Jika username dan password sama
        if ($username === $password && !empty($username)) {
            return redirect('/dashboard')->with('success', 'Selamat datang di Dashboard Admin!');
        }

        // Jika salah/beda, kembali ke halaman login dengan Alert
        return redirect('/auth')->with('error', 'Username atau Password salah!');
    }
}