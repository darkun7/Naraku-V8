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
            'jumlah'    =>'sometimes|max:11',
            'nama'      =>'sometimes|max:64',
            'satuan'    =>'sometimes|',
            'bahan'     =>'sometimes|max:11'
        ];
    }
}
