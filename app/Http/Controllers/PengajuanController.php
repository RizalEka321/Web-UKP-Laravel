<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prodi;
use App\Models\Kategori;
use App\Models\Kerjasama;
use App\Models\Pengajuan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Trait\TambahKategoriDanProdi;
use App\Http\Requests\PengajuanKerjasamaRequest;
use App\Http\Requests\UpdateKerjasamaRequest;
use Carbon\Carbon;

class PengajuanController extends Controller
{
    public function pengajuanKerjasama()
    {
        if (Auth::user()->role != "mitra") {
            return abort(403, 'Unauthorized action.');
        }

        return view('mitra.pengajuan.pengajuan-kerjasama', [
            'prodi'     =>  Prodi::all(),
            'kategori'  =>  Kategori::all(),
            'title'     => 'Tambah Pengajuan Kerjasama'
        ]);
    }
    public function store(PengajuanKerjasamaRequest $request)
    {
        $validated = $request->validated();
    
        try {
            $dataToStore = [
                'nama_instansi' => $validated['nama_instansi'],
                'nomor_perusahaan' => $validated['nomor_perusahaan'],
                'contact_person' => $validated['contact_person'],
                'jenis_kegiatan' => $validated['jenis_kegiatan'],
                'manfaat' => $validated['manfaat'],
                'tgl_mulai' => $validated['tgl_mulai'],
                'tgl_berakhir' => $validated['tgl_berakhir'],
                'implementasi' => $validated['implementasi'],
                'file_mou' => $validated['file_mou'],
                // ... tambahkan kolom-kolom yang diperlukan
            ];
    
            $kerjasama = Kerjasama::create($dataToStore);
    
            // Tambahkan proses lain jika diperlukan, seperti menyimpan relasi prodi
    
            return redirect('/pengajuan-kerja-sama')->with('success', 'Berhasil Mengajukan Kerjasama');
        } catch (\Throwable $e) {
            return redirect('/pengajuan-kerja-sama')->with('error', 'Gagal Mengajukan Kerjasama' . $e->getMessage());
        }
    }
    
}
