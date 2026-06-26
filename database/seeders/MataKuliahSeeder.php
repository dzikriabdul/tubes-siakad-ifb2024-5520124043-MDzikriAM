<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MataKuliah;

class MataKuliahSeeder extends Seeder
{
    public function run(): void
    {
        MataKuliah::insert([
            ['kode_matakuliah' => 'IF001', 'nama_matakuliah' => 'Pemrograman Web Lanjut', 'sks' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['kode_matakuliah' => 'IF002', 'nama_matakuliah' => 'Basis Data',             'sks' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['kode_matakuliah' => 'IF003', 'nama_matakuliah' => 'Jaringan Komputer',      'sks' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['kode_matakuliah' => 'IF004', 'nama_matakuliah' => 'Rekayasa Perangkat Lunak', 'sks' => 3, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}