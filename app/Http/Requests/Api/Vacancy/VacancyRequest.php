<?php

namespace App\Http\Requests\Api\Vacancy;

use Illuminate\Foundation\Http\FormRequest;

class VacancyRequest extends FormRequest
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
        $rules['requirements'] = ['required', 'string', 'max:1000'];
        $rules['conditions'] = ['required', 'string', 'max:1000'];
        $rules['salary'] = ['required', 'numeric', 'min:0', 'max:999999999999'];
        $rules['position_id'] = ['required', 'exists:positions,id'];
        $rules['skills'] = ['required', 'exists:skills,id'];

        return $rules;
    }
}
