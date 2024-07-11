<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Panduan;
use DOMDocument;

class PanduanController extends Controller
{
    public function index($id)
    {
        $panduan = Panduan::find($id);
        return view('admin.panduan.index', compact('panduan'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'file' => 'file|mimes:pdf|max:2048',
            'panduan' => 'required',
        ]);

        $panduans = Panduan::find($id);

        if (!$panduans) {
            return back()->with('error', 'Panduan not found.');
        }

        try {
            if ($request->hasFile('file')) {
                if (file_exists(public_path('data_panduan/' . $panduans->file))) {
                    unlink(public_path('data_panduan/' . $panduans->file));
                }

                $uploadedFile = $request->file('file');
                $nama_file = time() . "_" . $uploadedFile->getClientOriginalName();
                $tujuan_upload = 'data_panduan';
                $uploadedFile->move($tujuan_upload, $nama_file);
            } else {
                $nama_file = $panduans->file;
            }

            $panduan = $request->panduan;

            // Wrap the HTML content in a complete HTML structure
            $htmlContent = '<!DOCTYPE html><html><head><meta charset="UTF-8"></head><body>' . $panduan . '</body></html>';

            // Suppress errors and warnings
            $dom = new \DOMDocument();
            @$dom->loadHTML($htmlContent, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

            $images = $dom->getElementsByTagName('img');
            foreach ($images as $key => $img) {
                if (strpos($img->getAttribute('src'), 'data:image/') === 0) {
                    $data = base64_decode(explode(',', explode(';', $img->getAttribute('src'))[1])[1]);
                    $image_name = "/upload-panduan/" . time() . $key . '.png';
                    file_put_contents(public_path() . $image_name, $data);
                    $img->removeAttribute('src');
                    $img->setAttribute('src', $image_name);
                }
            }

            $panduan = $dom->saveHTML($dom->getElementsByTagName('body')->item(0));
            $panduan = str_replace(['<body>', '</body>'], '', $panduan);

            $panduans->update([
                'file' => $nama_file,
                'panduan' => $panduan,
            ]);

            return back()->with('success', 'Panduan updated successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Error updating panduan: ' . $e->getMessage());
        }
    }
}
