<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreServiceType extends FormRequest
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
             'name' => 'required|max:255|unique:service_types,name,' . ($this->service_type?$this->service_type->id:0),
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Не указано название',
        ];
    }
}
