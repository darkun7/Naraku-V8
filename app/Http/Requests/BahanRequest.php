<?php

namespace App\Http\Requests;

use App\Models\Bahan;
use Illuminate\Foundation\Http\FormRequest;

class BahanRequest extends FormRequest
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
            'jumlah'    =>'required|max:11',
            'nama'      =>'required|max:64',
            'satuan'    =>'required|',
            'bahan'     =>'required|max:11'
        ];
    }
}
