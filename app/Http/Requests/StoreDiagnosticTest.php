<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDiagnosticTest extends FormRequest
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
            'object_id' => 'required'
            'fact_id' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'object_id.required' => 'Не указан объект',
            'fact_id.required' => 'Не указан факт',
        ];
    }
}
