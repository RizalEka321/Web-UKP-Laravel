<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visimisi;
use DOMDocument;

class VisimisiController extends Controller
{
    public function index($id)
    {
        $visimisi = Visimisi::find($id);
        return view('admin.visimisi.index', compact('visimisi'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'visimisi' => 'required',
        ]);

        $visimisis = Visimisi::find($id);

        if (!$visimisis) {
            return back()->with('error', 'Visi Misi not found.');
        }

        try {
            $visimisi = $request->visimisi;

            // Wrap the HTML content in a complete HTML structure
            $htmlContent = '<!DOCTYPE html><html><head><meta charset="UTF-8"></head><body>' . $visimisi . '</body></html>';

            // Suppress errors and warnings
            $dom = new \DOMDocument();
            @$dom->loadHTML($htmlContent, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

            $images = $dom->getElementsByTagName('img');
            foreach ($images as $key => $img) {
                if (strpos($img->getAttribute('src'), 'data:image/') === 0) {
                    $data = base64_decode(explode(',', explode(';', $img->getAttribute('src'))[1])[1]);
                    $image_name = "/upload-visimisi/" . time() . $key . '.png';
                    file_put_contents(public_path() . $image_name, $data);
                    $img->removeAttribute('src');
                    $img->setAttribute('src', $image_name);
                }
            }

            // Extract and clean the body content
            $bodyContent = $dom->saveHTML($dom->getElementsByTagName('body')->item(0));
            $bodyContent = str_replace(['<body>', '</body>'], '', $bodyContent);

            $visimisis->update([
                'visimisi' => $bodyContent,
            ]);

            return back()->with('success', 'Visi Misi updated successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Error updating visi misi: ' . $e->getMessage());
        }
    }
}
