<?php

namespace App\Models; // Namespace tempat model ini berada

use Illuminate\Database\Eloquent\Factories\HasFactory; // Trait untuk factory (digunakan di seeder atau testing)
use Illuminate\Database\Eloquent\Model; // Kelas dasar untuk semua model Eloquent

class KontakModel extends Model
{
    use HasFactory; // Aktifkan fitur factory untuk model ini

    protected $table = 'kontak'; // Nama tabel di database yang digunakan model ini
    protected $primaryKey = 'id'; // Primary key dari tabel
    protected $fillable = ['nama', 'nomor_hp', 'email', 'alamat']; 
    // Kolom-kolom yang boleh diisi massal (digunakan saat create/update data)
}
