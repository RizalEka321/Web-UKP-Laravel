<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TambahUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // Set ke true, karena kita mengizinkan semua orang untuk mengakses formulir ini.
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'no_hp' => 'required|string|max:255',
            'role' => 'required|string|max:255',
            'password' => 'required|min:8|confirmed',
            // Sesuaikan dengan kolom dan aturan validasi lainnya
        ];
    }
}
