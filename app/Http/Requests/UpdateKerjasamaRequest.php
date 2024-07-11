<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateKerjasamaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nomor_mou' => 'required',
            'nama_contact_person_old' =>  'required',
            'kriteria' => 'required',
            'email_instansi' => 'required',
            'alamat_instansi' => 'required',
            'nama_instansi' => 'required',
            'nama_contact_person' => 'required',
            'contact_person' => 'required',
            'jenis_kegiatan' => 'required',
            'prodi' => 'required',
            'kategori' => 'required',
            'mou' =>  'nullable|mimes:docx,pdf',
            'hard_file' => 'required',
            'tgl_mulai' => 'required|date|before:tgl_berakhir',
            'tgl_berakhir' => 'required|date',
            'status' => 'required',
        ];
    }
}
