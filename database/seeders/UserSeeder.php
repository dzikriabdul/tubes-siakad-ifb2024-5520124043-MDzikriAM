<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'name'     => 'Admin',
            'email'    => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'role'     => 'admin',
        ]);

        // Mahasiswa 1
        User::create([
            'name'     => 'Muhammad Dzikri Abdul Muti',
            'email'    => 'dzikri@gmail.com',
            'password' => Hash::make('password'),
            'role'     => 'mahasiswa',
        ]);

        // Mahasiswa 2
        User::create([
            'name'     => 'Abdurahman',
            'email'    => 'Abdurahman@gmail.com',
            'password' => Hash::make('password'),
            'role'     => 'mahasiswa',
        ]);

        // Mahasiswa 3
        User::create([
            'name'     => 'RafiLadzuardi',
            'email'    => 'Rafil@gmail.com',
            'password' => Hash::make('password'),
            'role'     => 'mahasiswa',
        ]);
    }
}