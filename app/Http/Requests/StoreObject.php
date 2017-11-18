<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreObject extends FormRequest
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
            'name' => 'required|max:255',
            'subdivision_id' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Не указано название',
            'subdivision_id.required' => 'Не указано подразделение'
        ];
    }
}
