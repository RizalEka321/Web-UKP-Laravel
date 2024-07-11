<?php

namespace App\Http\Controllers;

use DOMDocument;

use App\Models\Post;
use App\Models\Kategori;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::paginate(10);
        return view('admin.aktivitas.index', compact('posts'));
    }

    public function create()
    {
        $kategori = Kategori::all();
        return view('admin.aktivitas.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'id_kategori' => 'required',
            'nomor_mou' => 'required',
            'kegiatan' => 'required',
            'tanggal' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'deskripsi' => 'required',
        ]);

        try {
            $foto = $request->file('foto');
            $nama_file = time() . "_" . $foto->getClientOriginalName();
            $tujuan_upload = 'data_aktivitas';
            $foto->move($tujuan_upload, $nama_file);

            $deskripsi = $request->deskripsi;
            $dom = new DOMDocument();
            $dom->loadHTML($deskripsi, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            $images = $dom->getElementsByTagName('img');
            foreach ($images as $key => $img) {
                $data = base64_decode(explode(',', explode(';', $img->getAttribute('src'))[1])[1]);
                $image_name = "/upload/" . time() . $key . '.png';
                file_put_contents(public_path() . $image_name, $data);

                $img->removeAttribute('src');
                $img->setAttribute('src', $image_name);
            }
            $deskripsi = $dom->saveHTML();

            Post::create([
                'id_kategori' => $request->id_kategori,
                'nomor_mou' => $request->nomor_mou,
                'kegiatan' => $request->kegiatan,
                'tanggal' => $request->tanggal,
                'foto' => $nama_file,
                'deskripsi' => $deskripsi
            ]);

            return redirect()->route('aktivitas')->with('success', 'Aktivitas berhasil disimpan.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat menyimpan aktivitas: ' . $e->getMessage());
        }
    }


    public function show($id)
    {
        $post = Post::find($id);
        return view('admin.aktivitas.show', compact('post'));
    }

    public function edit($id)
    {
        $post = Post::find($id);
        $kategori = Kategori::all();
        return view('admin.aktivitas.edit', compact('post', 'kategori'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'id_kategori' => 'required',
            'kegiatan' => 'required',
            'nomor_mou' => 'required',
            'tanggal' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'deskripsi' => 'required',
        ]);

        $post = Post::find($id);

        if (!$post) {
            return back()->with('error', 'Post not found.');
        }

        try {
            if ($request->hasFile('foto')) {
                if (file_exists(public_path('data_aktivitas/' . $post->foto))) {
                    unlink(public_path('data_aktivitas/' . $post->foto));
                }

                $uploadedFile = $request->file('foto');
                $nama_file = time() . "_" . $uploadedFile->getClientOriginalName();
                $tujuan_upload = 'data_aktivitas';
                $uploadedFile->move($tujuan_upload, $nama_file);
            } else {
                $nama_file = $post->foto;
            }

            $deskripsi = $request->deskripsi;
            $dom = new DOMDocument();
            $dom->loadHTML($deskripsi, 9);
            $images = $dom->getElementsByTagName('img');
            foreach ($images as $key => $img) {
                if (strpos($img->getAttribute('src'), 'data:image/') === 0) {
                    $data = base64_decode(explode(',', explode(';', $img->getAttribute('src'))[1])[1]);
                    $image_name = "/upload/" . time() . $key . '.png';
                    file_put_contents(public_path() . $image_name, $data);
                    $img->removeAttribute('src');
                    $img->setAttribute('src', $image_name);
                }
            }
            $deskripsi = $dom->saveHTML();

            $post->update([
                'id_kategori' => $request->id_kategori,
                'kegiatan' => $request->kegiatan,
                'nomor_mou' => $request->nomor_mou,
                'tanggal' => $request->tanggal,
                'foto' => $nama_file,
                'deskripsi' => $deskripsi
            ]);

            return redirect()->route('aktivitas')->with('success', 'Aktivitas berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat memperbarui aktivitas: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $post = Post::find($id);
        $dom = new DOMDocument();
        $dom->loadHTML($post->deskripsi, 9);
        $images = $dom->getElementsByTagName('img');
        foreach ($images as $key => $img) {
            $src = $img->getAttribute('src');
            $path = Str::of($src)->after('/');
            if (File::exists($path)) {
                File::delete($path);
            }
        }
        $post->delete();
        return redirect()->back();
    }
}
