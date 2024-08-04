<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'password' => Hash::make('admin'),
            'role' => 'admin',
        ]);
        User::create([
            'name' => 'Pemilik',
            'username' => 'pemilik',
            'password' => Hash::make('pemilik'),
            'role' => 'pemilik',
        ]);
        User::create([
            'name' => 'Karyawan',
            'username' => 'karyawan',
            'password' => Hash::make('karyawan'),
            'role' => 'karyawan',
        ]);
        User::create([
            'name' => 'Apoteker',
            'username' => 'apoteker',
            'password' => Hash::make('apoteker'),
            'role' => 'apoteker',
        ]);
    }
}
