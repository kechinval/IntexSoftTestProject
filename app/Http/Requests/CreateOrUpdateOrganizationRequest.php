<?php

namespace App\Http\Requests;

use App\Rules\OGRN;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateOrUpdateOrganizationRequest extends FormRequest
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
    public function rules($data)
    {
        return [
            'name' => [
                'required',
                'min:2',
                'max:255',
                'string',
                Rule::unique('organizations')
                    ->ignore($data['name'], 'name')],
            'ogrn' => [
                'required',
                'numeric',
                'digits:13',
                Rule::unique('organizations')
                    ->ignore($data['ogrn'], 'ogrn'),
                new OGRN(),
            ],
            'oktmo' => ['required', 'numeric', 'digits:11'],
        ];
    }
}
