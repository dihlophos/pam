<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUser extends FormRequest
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
             'username' => 'required|max:255|unique:users,username,'.($this->user?$this->user->id:0),
             'displayname' => 'required|max:255|unique:users,displayname,'.($this->user?$this->user->id:0),
             'email' => 'email'
        ];
    }

    public function messages()
    {
        return [
            'username.required' => 'Не указан логин',
            'displayname.required' => 'Не указано ФИО',
            'email.email'=>'Не верно указан адрес электронной почты'
        ];
    }
}
