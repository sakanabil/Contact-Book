<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KontakSeeder extends Seeder
{
    public function run()
    {
        DB::table('kontak')->insert([
            [
                'nama' => 'Budi Santoso',
                'nomor_hp' => '081234567890',
                'email' => 'budi@example.com',
                'alamat' => 'Jl. Merpati No. 10, Jakarta',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Siti Aminah',
                'nomor_hp' => '082345678901',
                'email' => 'siti@example.com',
                'alamat' => 'Jl. Melati No. 5, Bandung',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Andi Pratama',
                'nomor_hp' => '083456789012',
                'email' => 'andi@example.com',
                'alamat' => 'Jl. Kenanga No. 2, Surabaya',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
