<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PengajuanKerjasamaRequest extends FormRequest
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
            'nama_instansi'     => 'required',
            'nomor_perusahaan'  => 'required',
            'contact_person'    => 'required',
            'jenis_kegiatan'    => 'required',
            'manfaat'           => 'required',
            'tgl_mulai'         => 'required|date|before:tgl_berakhir',
            'tgl_berakhir'      => 'required|date',
            'implementasi'      => 'required',
            'file_mou'               =>  'required|mimes:docx,pdf',
        ];
    }
}
