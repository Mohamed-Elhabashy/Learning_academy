<?php

namespace App\Http\Requests\Student;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentRequest extends FormRequest
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
            'name'  => ['nullable', 'string', 'max:191'],
            'email' => ['required', 'email', 'max:191', 'unique:students'],
            'spec'  => ['nullable', 'string', 'max:191'],
        ];
    }
}
