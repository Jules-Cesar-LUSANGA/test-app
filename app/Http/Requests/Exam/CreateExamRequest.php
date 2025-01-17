<?php

namespace App\Http\Requests\Exam;

use Illuminate\Foundation\Http\FormRequest;

class CreateExamRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'course_name' => ['required', 'string', 'max:255'],
            'attempts'    => ['required', 'min:1', 'integer'],
            'description' => ['required', 'string'],
            'duration'    => ['required', 'integer', 'min:1'],
        ];
    }
}
