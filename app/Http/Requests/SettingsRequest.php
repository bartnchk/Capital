<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingsRequest extends FormRequest
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
            'email' => 'email|min:6',
            'phone' => 'max:14',
            'viber' => 'max:14'
        ];
    }

    public function messages()
    {
        return [
            'email.email' => 'Не корректный e-mail',
            'email.min'      => 'Слишком короткий e-mail',
            'phone.max' => 'Максимальный размер номера телефона - 14 символов',
            'viber.max' => 'Максимальный размер Viber - 14 символов'
        ];
    }
}
