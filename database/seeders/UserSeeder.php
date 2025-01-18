<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'username' => 'admin',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);
        User::create([
            'username' => 'dosen',
            'password' => Hash::make('dosen123'),
            'role' => 'dosen',
        ]);
        User::create([
            'username' => 'mahasiswa',
            'password' => Hash::make('mahasiswa123'),
            'role' => 'mahasiswa',
        ]);
    }
}
