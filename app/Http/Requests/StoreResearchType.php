<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreResearchType extends FormRequest
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
            'name' => 'required|max:255|unique:research_types,name,' . ($this->research_type?$this->research_type->id:0)
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Не указано название',
        ];
    }
}
