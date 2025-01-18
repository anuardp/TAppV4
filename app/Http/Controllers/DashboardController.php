<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function adminDashboard()
    {
        return view('admin.dashboard');
    }

    public function dosenDashboard()
    {
        return view('dosen.dashboard');
    }

    public function mahasiswaDashboard()
    {
        return view('mahasiswa.dashboard');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
