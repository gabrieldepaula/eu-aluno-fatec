<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveTaskRequest extends FormRequest
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
            'subject_id'        => 'required|exists:subjects,id',
            'title'             => 'required|string|min:3|max:255',
            'notes'             => 'nullable|string|max:2000',
            'delivery_date'     => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'subject_id'        => 'matéria',
            'title'             => 'título',
            'notes'             => 'observações',
            'delivery_date'     => 'data de entrega',
        ];
    }
}
