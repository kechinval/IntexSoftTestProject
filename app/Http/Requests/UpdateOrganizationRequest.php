<?php

namespace App\Http\Requests;

use App\Rules\OGRN;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateOrganizationRequest extends FormRequest
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
            'name' => [
                'required',
                'min:2',
                'max:255',
                'string',
                Rule::unique('organizations', 'name')
                    ->ignore($this->organization)],
            'ogrn' => [
                'required',
                'numeric',
                'digits:13',
                Rule::unique('organizations', 'ogrn')
                    ->ignore($this->organization),
                new OGRN(),
            ],
            'oktmo' => ['required', 'numeric', 'digits:11'],
        ];
    }
}
