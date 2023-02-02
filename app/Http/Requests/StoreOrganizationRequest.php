<?php

namespace App\Http\Requests;

use App\Rules\OGRN;
use Illuminate\Foundation\Http\FormRequest;

class StoreOrganizationRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required', 'min:2', 'max:255', 'string', 'unique:organizations,name'],
            'ogrn' => ['required', 'numeric', 'digits:13', 'unique:organizations,ogrn', new OGRN()],
            'oktmo' => ['required', 'numeric', 'digits:11'],
        ];
    }
}
