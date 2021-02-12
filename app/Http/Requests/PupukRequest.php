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
            'id'            =>'sometimes|max:11',
            'nama'          =>'sometimes|max:64',
            'deskripsi'     =>'sometimes',
            'harga'         =>'sometimes|max:11',
            'id_bahan'      =>'sometimes|max:11',
            'rasio'         =>'sometimes',
            'satuan'        =>'sometimes'
        ];
    }
}
