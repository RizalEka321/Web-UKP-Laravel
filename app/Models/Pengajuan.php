<?php

// app/Models/PengajuanKerjasama.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    use HasFactory;

    protected $table = 'kerjasamas'; // Sesuaikan nama tabel dengan kebutuhan Anda

    protected $fillable = [
        'nama_instansi',
        'nomor_perusahaan',
        'contact_person',
        'jenis_kegiatan',
        'manfaat',
        'tgl_mulai',
        'tgl_berakhir',
        'implementasi',
        'mou',
    ];

    public function prodi()
    {
        return $this->belongsToMany(Prodi::class, 'kerjasama_prodi', 'id_kerjasama', 'id_prodi');
    }

    // Definisikan relasi lain yang diperlukan di sini

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
