<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KontakSeeder extends Seeder
{
    // Fungsi untuk menjalankan seeder
    public function run()
    {
        // Menyisipkan data dummy ke tabel 'kontak'
        DB::table('kontak')->insert([
            [
                'nama' => 'Budi Santoso', // Nama kontak
                'nomor_hp' => '081234567890', // Nomor HP
                'email' => 'budi@example.com', // Alamat email
                'alamat' => 'Jl. Merpati No. 10, Jakarta', // Alamat rumah
                'created_at' => now(), // Timestamp saat data dibuat
                'updated_at' => now(), // Timestamp saat data diperbarui
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
