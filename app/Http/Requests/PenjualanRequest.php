<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PenjualanRequest extends FormRequest
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
            'nama_pemesan'  => 'required|max:128',
            'id_pupuk'      => 'required|array|min:1',
            'jumlah'        => 'required|array|min:1',
            'kontak'        => 'required|max:15',
            'alamat'        => 'required'
        ];
    }
}
