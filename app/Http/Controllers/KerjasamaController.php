<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use App\Models\Kategori;
use App\Models\Kerjasama;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\TambahKerjasamaRequest;
use App\Http\Requests\UpdateKerjasamaRequest;
use Carbon\Carbon;

class KerjasamaController extends Controller
{
    public function index()
    {
        $kerjasama = Kerjasama::with('kategori', 'prodi')->orderBy('id_kerjasama', 'DESC')->paginate(5);
        $prodis = Prodi::all();
        return view('admin.kerjasama.index', [
            'title' => 'Daftar Kerjasama',
            'prodis' => $prodis,
            'kerjasama' => $kerjasama
        ]);
    }

    public function create()
    {
        return view('admin.kerjasama.create', [
            'prodi'     =>  Prodi::all(),
            'kategori'  =>  Kategori::all(),
            'title'     => 'Tambah Data Kerjasama'
        ]);
    }

    public function store(TambahKerjasamaRequest $request)
    {
        $validated = $request->validated();
        $fileMou = $request->file('mou');
        foreach ($validated['prodi'] as $value) {
            if (is_numeric($value) != 1) {
                $id = $this->tambahProdi($value);
                $key = array_search($value, $validated['prodi']);
                unset($validated['prodi'][$key]);
                array_push($validated['prodi'], $id);
            }
        }
        if (is_numeric($validated['kategori']) != 1) {
            $validated['kategori'] = $this->tambahKategori($validated['kategori']);
        }
        try {
            $nomorMouFile = str_replace('/', '-', $validated['nama_contact_person']);
            $fileMou->storeAs('public/file-mou', $nomorMouFile . "." . $fileMou->getClientOriginalExtension());
            $validated['id_user'] = Auth::user()->id;
            $validated['id_kategori'] = $validated['kategori'];
            if (Auth::user()->role == "admin") {
                $validated['status'] = 1;
            }
            $validated['file_mou'] = $nomorMouFile . '.' . $fileMou->getClientOriginalExtension();
            $permohonan = Kerjasama::create($validated);
            $permohonan->prodi()->attach($validated['prodi']);
            return redirect('/kerjasama')->with('success', 'Berhasil Menambahkan Data Kerjasama');
        } catch (\Throwable $e) {
            return $e;
            return redirect('/kerjasama/create')->with('error', 'Gagal Menambahkan Data Kerjasama');
        }
    }

    public function edit($id)
    {
        $kerjasama = Kerjasama::with(['prodi', 'kategori'])->findOrFail($id);
        $selectedProdi = [];
        foreach ($kerjasama->prodi as $key) {
            $selectedProdi[] = $key->id_prodi;
        }
        return  view('admin.kerjasama.edit', [
            'title' => 'Detail Kerjasama',
            'kerjasama' => $kerjasama,
            'prodi'     =>  Prodi::all(),
            'kategori'  =>  Kategori::all(),
            'selectedProdi' =>  $selectedProdi
        ]);
    }

    public function update(UpdateKerjasamaRequest $request, $id)
    {
        try {
            $validated = $request->validated();
            foreach ($validated['prodi'] as &$value) {
                if (!is_numeric($value)) {
                    $idProdi = $this->tambahProdi($value);
                    $value = $idProdi;
                }
            }

            if (!is_numeric($validated['kategori'])) {
                $validated['kategori'] = $this->tambahKategori($validated['kategori']);
            }

            $fileMou = $request->file('file_mou');

            if (!empty($fileMou)) {
                $this->prosesFileMou($fileMou, $validated);
            }

            $validated['id_user'] = Auth::user()->id;
            $validated['id_kategori'] = $validated['kategori'];

            $permohonan = Kerjasama::findOrFail($id);
            $permohonan->update($validated);
            $permohonan->prodi()->sync($validated['prodi']);

            return redirect('/kerjasama')->with('success', 'Berhasil Mengubah Data Kerjasama');
        } catch (\Throwable $e) {
            return $e;
        }
    }

    public function destroy($id)
    {
        try {
            $kerjasama = Kerjasama::findOrFail($id);
            $kerjasama->delete();
            return redirect('/kerjasama')->with('success', 'Berhasil Menghapus Data Kerjasama');
        } catch (\Throwable $e) {
            return $e;
            return redirect('/kerjasama')->with('error', 'Gagal Menghapus Data Kerjasama');
        }
    }

    public function show($id)
    {
        $kerjasama = Kerjasama::with(['prodi', 'kategori'])->findOrFail($id);
        $selectedProdi = [];
        foreach ($kerjasama->prodi as $key) {
            $selectedProdi[] = $key->id_prodi;
        }
        return  view('admin.kerjasama.show', [
            'title' => 'Detail Kerjasama',
            'kerjasama' => $kerjasama,
            'prodi'     =>  Prodi::all(),
            'kategori'  =>  Kategori::all(),
            'selectedProdi' =>  $selectedProdi
        ]);
    }

    public function download($mou)
    {
        if (Storage::exists('public/file-mou/' . $mou)) {
            return Storage::download('public/file-mou/' . $mou);
        } elseif (Storage::exists('public/file-mou/' . $mou)) {
            return Storage::download('public/file-mou/' . $mou);
        } else {
            return redirect('/data-kerjasama')->with('error', 'Gagal Download File Mou, File Tidak Ada');
        }
    }

    private function prosesFileMou($fileMou, &$validated)
    {
        $validated['nama_contact_person_old'] = str_replace(['/', '.'], '-', $validated['nama_contact_person_old']);
        $nomorMouFile = str_replace(['/', '.'], '-', $validated['nama_contact_person']);

        $oldFilePath = 'public/file-mou/' . $validated['nama_contact_person_old'];
        if (Storage::exists($oldFilePath . '.pdf')) {
            Storage::delete($oldFilePath . '.pdf');
        } elseif (Storage::exists($oldFilePath . '.docx')) {
            Storage::delete($oldFilePath . '.docx');
        } else {
            return "gagal";
        }

        $validated['file_mou'] = $nomorMouFile . '.' . $fileMou->getClientOriginalExtension();
        $fileMou->storeAs('public/file-mou/', $validated['file_mou']);
    }

    public function cari(Request $request)
    {
        $cari = $request->cari;
        $expired = $request->expired;
        $sort = $request->sort;
        $prodi = $request->prodi;
        $kerjasama = Kerjasama::query();
        $prodis = Prodi::all();

        $kerjasama->when($cari != null, function ($q) use ($cari) {
            return $q->where('nomor_mou', 'like', "%" . $cari . "%")
                ->orWhere('nama_instansi', 'like', "%" . $cari . "%");
        });

        $kerjasama->when($expired == 'berakhir', function ($q) {
            return $q->where('tgl_berakhir', '<=', Carbon::now());
        });

        $kerjasama->when($expired == 'akan_berakhir', function ($q) {
            return $q->whereBetween('tgl_berakhir', [Carbon::now(), Carbon::now()->addMonth(3)]);
        });

        $kerjasama->when($prodi != null, function ($q) use ($prodi) {
            return $q->whereHas('prodi', function ($q) use ($prodi) {
                $q->where('prodis.id_prodi', $prodi);
            });
        });

        if ($sort == 'name') {
            $kerjasama->orderBy('nama_instansi');
        } elseif ($sort == 'tanggal_mulai') {
            $kerjasama->orderBy('tgl_mulai');
        } elseif ($sort == 'tanggal_berakhir') {
            $kerjasama->orderBy('tgl_berakhir');
        }

        // @dd($kerjasama);

        return view('admin.kerjasama.index', [
            'title' => 'Data Kerjasama',
            'prodis' => $prodis,
            'kerjasama' => $kerjasama->orderBy('id_kerjasama', 'DESC')->paginate(10)
        ]);
    }
}
