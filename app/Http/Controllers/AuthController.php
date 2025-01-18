<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('username', 'password'))) {
            $role = Auth::user()->role;
            if ($role === 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($role === 'dosen') {
                return redirect()->route('dosen.dashboard');
            } elseif ($role === 'mahasiswa') {
                return redirect()->route('mahasiswa.dashboard');
            }
        }

        return back()->with('error', 'Username atau password salah!');
    }
}
