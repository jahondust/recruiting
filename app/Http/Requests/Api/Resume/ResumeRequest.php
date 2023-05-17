<?php

namespace App\Http\Requests\Api\Resume;

use Illuminate\Foundation\Http\FormRequest;

class ResumeRequest extends FormRequest
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
        $rules['name'] = ['required', 'string'];
        $rules['description'] = ['nullable', 'string', 'max:1000'];
        $rules['avatar'] = ['nullable', 'mimes:jpg,png,gif,svg', 'max:1024'];
        $rules['salary'] = ['nullable', 'numeric', 'min:0', 'max:999999999999'];
        $rules['experience'] = ['required', 'numeric'];
        $rules['education'] = ['nullable', 'string', 'max:1000'];
        $rules['positions'] = ['required', 'exists:positions,id'];
        $rules['skills'] = ['required', 'exists:skills,id'];
        $rules['languages'] = ['required', 'exists:languages,id'];

        return $rules;
    }
}
