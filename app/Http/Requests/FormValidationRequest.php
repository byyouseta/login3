<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\PesertaValidation;

class FormValidationRequest extends FormRequest
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
            //
            'peserta' => ['required', new PesertaValidation]
        ];
    }

    public function messages()
    {
        return [
            'peserta.required' => 'Peserta sudah dimasukkan ke daftar peserta undangan'
        ];
    }
}
