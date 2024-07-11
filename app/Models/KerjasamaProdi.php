<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KerjasamaProdi extends Model
{
    use HasFactory;

    protected $table = 'kerjasama_prodis'; // Sesuaikan dengan nama tabel pivot yang sesuai

    protected $fillable = [
        'id_kerjasama',
        'id_prodi',
        // Tambahan kolom lain yang mungkin Anda miliki pada tabel pivot
    ];

    // Optional: Jika Anda ingin menonaktifkan timestamp pada tabel pivot
    public $timestamps = false;

    // Relasi ke model Kerjasama
    public function kerjasama()
    {
        return $this->belongsTo(Kerjasama::class, 'id_kerjasama', 'id_kerjasama');
    }

    // Relasi ke model Prodi
    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'id_prodi', 'id_prodi');
    }
}
