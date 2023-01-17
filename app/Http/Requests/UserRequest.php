<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\INN;
use App\Rules\SNILS;

class UserRequest extends FormRequest
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
            'surname' => ['required', 'string', 'min:2', 'max:255'],
            'name' => ['required', 'string', 'min:2', 'max:255'],
            'patronymic' => ['required', 'string', 'min:2', 'max:255'],
            'birthdate' => ['nullable', 'string', 'date', 'before:today'],
            'inn' => ['required', 'string', 'digits:12', 'unique:users,inn', new INN()],
            'snils' => ['required', 'string', 'digits:11', 'unique:users,snils', new SNILS()],
            'organizations_id' => ['required'],
        ];
    }
}
