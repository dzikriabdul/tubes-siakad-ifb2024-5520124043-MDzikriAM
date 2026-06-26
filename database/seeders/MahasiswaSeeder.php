<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Mahasiswa;

class MahasiswaSeeder extends Seeder
{
    public function run(): void
    {
        Mahasiswa::insert([
            ['npm' => '2024010001', 'nama' => 'Muhammad Dzikri Abdul Muti', 'kelas' => 'A', 'created_at' => now(), 'updated_at' => now()],
            ['npm' => '2024010002', 'nama' => 'Abdurahman',                 'kelas' => 'B', 'created_at' => now(), 'updated_at' => now()],
            ['npm' => '2024010003', 'nama' => 'Rafiladzuardi',              'kelas' => 'C', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}