<?php

namespace App\Http\Controllers;

use App\Models\Struktur;
use Illuminate\Http\Request;

class StrukturController extends Controller
{
    public function index($id)
    {
        $struktur = Struktur::find($id);
        return view('admin.struktur.index', compact('struktur'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'ketua' => 'required',
            'sekretaris' => 'required',
            'staf' => 'required'
        ]);

        $struktur = Struktur::find($id);

        $struktur->update([
            'ketua' => $request->ketua,
            'sekretaris' => $request->sekretaris,
            'staf' => $request->staf
        ]);

        return back();
    }
}
