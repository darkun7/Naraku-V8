<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
            'maps'              => 'sometimes',
            'jumbotron_title'   => 'sometimes',
            'jumbotron_text'    => 'sometimes',
            'deskripsi'         => 'sometimes|min:200',
            'deskripsi_naraku'  => 'sometimes|min:200',
            'nomor_wa'          => 'sometimes|min:11|max:13',
            'instagram'         => 'sometimes|min:4'
        ];
    }
}
