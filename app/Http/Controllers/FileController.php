<?php

namespace App\Http\Controllers;

use App\Models\File_mou;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function index()
    {
        $file = File_mou::paginate(5);
        return view('admin.file.index', [
            'title' => 'Daftar File MOU',
            'file' => $file
        ]);
    }

    public function create()
    {
        return view('admin.file.create', [
            'title'     => 'Tambah Data File'
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama_file' => 'required',
            'file' => 'required|file|mimes:pdf|max:2048',
        ]);

        $file = $request->file('file');

        $nama_file = time() . "_" . $file->getClientOriginalName();

        $tujuan_upload = 'data_file';
        $file->move($tujuan_upload, $nama_file);

        File_mou::create([
            'nama_file' => $request->nama_file,
            'file' => $nama_file,
        ]);

        return redirect('/file-mou')->with('success', 'Berhasil Menambahkan Data File');
    }

    public function edit($id)
    {
        $file = File_mou::find($id);
        return view('admin.file.edit', [
            'title'     => 'Edit Data File',
            'file'     => $file
        ]);
    }

    public function update(Request $request, $id)
    {
        $file = File_mou::findOrFail($id);

        $rules = [
            'nama_file' => 'required',
            'file' => 'file|mimes:pdf|max:2048',
        ];

        $messages = [
            'file.mimes' => 'The file must be a PDF.',
            'file.max' => 'The file size must not exceed 2MB.',
        ];

        $this->validate($request, $rules, $messages);

        if ($request->hasFile('file')) {
            if (file_exists(public_path('data_file/' . $file->file))) {
                unlink(public_path('data_file/' . $file->file));
            }

            $uploadedFile = $request->file('file');
            $nama_file = time() . "_" . $uploadedFile->getClientOriginalName();
            $tujuan_upload = 'data_file';
            $uploadedFile->move($tujuan_upload, $nama_file);
        } else {
            $nama_file = $file->file;
        }

        $file->update([
            'nama_file' => $request->nama_file,
            'file' => $nama_file,
        ]);

        return redirect('/file-mou')->with('success', 'Data File berhasil diperbarui');
    }

    public function destroy($id)
    {
        $file = File_mou::find($id);
        $file->delete();
        return redirect()->back();
    }

    public function download($id)
    {
        $file = File_mou::find($id);
        return view('admin.file.download', [
            'title'     => 'Download File',
            'file'     => $file
        ]);
    }
}
