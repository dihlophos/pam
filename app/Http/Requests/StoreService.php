<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreService extends FormRequest
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
            'name' => 'required|max:255|unique:services,name,' . ($this->service?$this->service->id:0),
            'measure_id' => 'required',
            'tab_index' => 'required',
            'service_category_id' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Не указано название',
            'measure_id.required' => 'Не указаны единицы учета',
            'tab_index.required' => 'Не указана вкладка',
            'service_category_id.required' => 'Не указана категория услуги',
        ];
    }
}
