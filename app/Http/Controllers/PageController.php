<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Prodi;
use App\Models\Panduan;
use App\Models\File_mou;
use App\Models\Kategori;
use App\Models\Struktur;
use App\Models\Visimisi;
use App\Models\Kerjasama;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function page_home()
    {
        $total_luar_negeri = Kerjasama::whereHas('kategori', function ($query) {
            $query->where('nama_kategori', 'luar negeri');
        })->count();

        $total_instansi_pemerintah = Kerjasama::whereHas('kategori', function ($query) {
            $query->where('nama_kategori', 'instansi pemerintah');
        })->count();

        $total_bumn = Kerjasama::whereHas('kategori', function ($query) {
            $query->where('nama_kategori', 'bumn');
        })->count();

        $total_pt = Kerjasama::whereHas('kategori', function ($query) {
            $query->where('nama_kategori', 'perguruan tinggi');
        })->count();

        $total_industri = Kerjasama::whereHas('kategori', function ($query) {
            $query->where('nama_kategori', 'Industri, Masyarakat dan PKL');
        })->count();

        $total_all = Kerjasama::count();

        $aktivitas = Post::orderBy('tanggal', 'desc')->paginate(6);
        $aktivitas_lain = Post::paginate(6);

        return view('page.page_home', compact(
            'total_luar_negeri',
            'total_instansi_pemerintah',
            'total_bumn',
            'total_pt',
            'total_industri',
            'total_all',
            'aktivitas',
            'aktivitas_lain'
        ));
    }

    public function dataChart(Request $request)
    {
        $kerjasama = Kerjasama::selectRaw('COUNT(id_kerjasama) as total,YEAR(created_at) as tahun');
        $kerjasama->when($request->query('tahunDari') != "all", function ($q) use ($request) {
            $q->whereYear('created_at', '>=', trim($request->query('tahunDari')));
        });
        $kerjasama->when($request->query('tahunKe') != "all", function ($q) use ($request) {
            $q->whereYear('created_at', '<=', trim($request->query('tahunKe')));
        });
        $kerjasama->groupBy('tahun')->orderBy('created_at', 'ASC');
        $data = [];
        foreach ($kerjasama->get() as $key => $value) {
            $data['data'][] = $value->total;
            $data['label'][] = $value->tahun;
        }
        return response()->json($data, 200);
    }

    public function dataChartProdi(Request $request)
    {
        $prodi = Prodi::withCount(['kerjasama' => function ($query) use ($request) {
            $query->when($request->query('tahunDari') != "all", function ($q) use ($request) {
                $q->whereYear('kerjasamas.created_at', '>=', trim($request->query('tahunDari')));
            });
            $query->when($request->query('tahunKe') != "all", function ($q) use ($request) {
                $q->whereYear('kerjasamas.created_at', '<=', trim($request->query('tahunKe')));
            });
        }])->get();
        $data = [];
        foreach ($prodi as $key) {
            $data['nama_prodi'][] = $key->nama_prodi;
            $data['total'][] = $key->kerjasama_count;
        }
        return response()->json($data, 200);
    }

    public function dataChartKategori(Request $request)
    {
        $prodi = Kategori::withCount(['kerjasama' => function ($query) use ($request) {
            $query->when($request->query('tahunDari') != "all", function ($q) use ($request) {
                $q->whereYear('kerjasamas.created_at', '>=', trim($request->query('tahunDari')));
            });
            $query->when($request->query('tahunKe') != "all", function ($q) use ($request) {
                $q->whereYear('kerjasamas.created_at', '<=', trim($request->query('tahunKe')));
            });
        }])->get();
        $data = [];
        foreach ($prodi as $key) {
            $data['nama_kategori'][] = $key->nama_kategori;
            $data['total'][] = $key->kerjasama_count;
        }
        return response()->json($data, 200);
    }

    public function page_struktur()
    {
        $struktur = Struktur::find(1);
        return view('page.page_struktur', compact('struktur'));
    }

    public function page_visi_misi()
    {
        $visimisi = Visimisi::find(1);
        $aktivitas_lain = Post::paginate(6);
        return view('page.page_visi_misi', compact('visimisi', 'aktivitas_lain'));
    }

    public function page_aktivitas()
    {
        $aktivitas = Post::all();
        $kategori = Kategori::all();
        return view('page.page_aktivitas', compact('aktivitas', 'kategori'));
    }

    public function page_detail_aktivitas($id)
    {
        $aktivitas = Post::find($id);
        $aktivitas_lain = Post::orderBy('tanggal', 'desc')->get();
        return view('page.page_aktivitas_detail', compact('aktivitas', 'aktivitas_lain'));
    }

    public function page_panduan()
    {
        $panduan = Panduan::find(1);
        $aktivitas_lain = Post::paginate(6);
        return view('page.page_panduan', compact('panduan', 'aktivitas_lain'));
    }

    public function page_download()
    {
        $file = File_mou::paginate(5);
        return view('page.page_download', compact('file'));
    }

    public function download($id)
    {
        $file = File_mou::find($id);
        return view('admin.file.downloadFile', compact('file'));
    }

    public function page_kerjasama()
    {
        $kerjasama = Kerjasama::paginate(10);
        $aktivitas_lain = Post::paginate(6);
        return view('page.page_kerjasama', compact('kerjasama', 'aktivitas_lain'));
    }
}
