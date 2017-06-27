<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAnimal extends FormRequest
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
            'animal_type_id' => 'required',
            'age' => 'required',
            'count' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'animal_type_id.required' => 'Не указан вид животного',
            'age.required' => 'Не указан возраст',
            'count.required' => 'Не указано количество',
        ];
    }
}
