<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PupukRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return True;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nama'          =>'required|max:64',
            'deskripsi'     =>'required',
            'harga'         =>'required|max:11',
            'id_bahan'      =>'required|array|min:2',
            'rasio'         =>'required|array|min:2',
            'satuan'        =>'required|array|min:2'
        ];
    }
}
