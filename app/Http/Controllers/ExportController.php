<?php

// app/Http/Controllers/ExportController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\Models\Kerjasama;

class ExportController extends Controller
{
    public function exportPDF($id)
    {
        $kerjasama = Kerjasama::findOrFail($id);

        $pdf = PDF::loadView('admin.kerjasama.export', compact('kerjasama'));

        return $pdf->download('kerjasama.pdf');
    }
}
