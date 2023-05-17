<?php

namespace App\Http\Requests\Api\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $rules = [];
        $rules['name'] = ['required', 'unique:users,name'];
        $rules['email'] = ['required', 'unique:users,email'];
        $rules['password'] = ['required', 'confirmed', 'min:6'];
        $rules['first_name'] = ['required', 'string'];
        $rules['last_name'] = ['required', 'string'];
        $rules['middle_name'] = ['required', 'string'];
        $rules['phone'] = ['nullable', 'string'];
        $rules['address'] = ['nullable', 'string'];

        return $rules;
    }
}
