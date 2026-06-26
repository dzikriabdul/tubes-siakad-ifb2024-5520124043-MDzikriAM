<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Dosen;

class DosenSeeder extends Seeder
{
    public function run(): void
    {
        Dosen::insert([
            ['nidn' => '0101019001', 'nama' => 'Siti Nazillah ST.,M.kom', 'created_at' => now(), 'updated_at' => now()],
            ['nidn' => '0202029002', 'nama' => 'Dr. Rina Marlina', 'created_at' => now(), 'updated_at' => now()],
            ['nidn' => '0303039003', 'nama' => 'Lalan Jaelani ST.,M.kom', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}