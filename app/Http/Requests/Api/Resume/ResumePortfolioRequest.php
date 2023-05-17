<?php

namespace App\Http\Requests\Api\Resume;

use Illuminate\Foundation\Http\FormRequest;

class ResumePortfolioRequest extends FormRequest
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
        $rules['description'] = ['nullable', 'string', 'max:1000'];
        $rules['file'] = ['required', 'mimes:jpg,png,gif,svg', 'max:1024'];

        return $rules;
    }
}
