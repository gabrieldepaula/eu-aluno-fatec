<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveConfigRequest extends FormRequest
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
            'name'                  => 'required|string|min:3|max:255',
            'password'              => 'nullable|string|min:3|max:255|confirmed',
            'college_id'            => 'required|exists:colleges,id',
            'course_id'             => 'required|exists:courses,id',
            'subjects'              => 'required|array',
            'subjects.*'            => 'exists:subjects,id',
        ];
    }

    public function attributes()
    {
        return [
            'name'                  => 'nome',
            'password'              => 'nova senha',
            'password_confirmation' => 'confirmação da nova senha',
            'college_id'            => 'fatec',
            'course_id'             => 'curso',
            'subjects'              => 'matérias',
        ];
    }
}
