<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMaterialType extends FormRequest
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
             'name' => 'required|max:255|unique:material_types,name,' . ($this->material_type?$this->material_type->id:0),
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Не указано название',
        ];
    }
}
