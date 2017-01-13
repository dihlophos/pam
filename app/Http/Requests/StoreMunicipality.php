<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMunicipality extends FormRequest
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
            'name' => 'required|max:255|unique:municipalities,name,' . ($this->municipality?$this->municipality->id:0),
            'district_id' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Не указано название',
        ];
    }
}
