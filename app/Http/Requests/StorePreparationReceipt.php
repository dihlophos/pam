<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePreparationReceipt extends FormRequest
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
            //'name' => 'required|max:255|unique:preparation_receipts,name,'.($this->preparation_receipt?$this->preparation_receipt->id:0),
        ];
    }

    public function messages()
    {
        return [
            //'name.required' => 'Не указано название',
        ];
    }
}
