<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UserEditRequest extends FormRequest
{
    protected $rules = [
        'name'                      => 'required|min:4',
        'email'                     => 'required|email',
        'password'                  => 'required|confirmed|min:4',
        'password_confirmation'     => 'required|min:4',
        'new_password'              => 'required|confirmed|min:4',
        'new_password_confirmation' => 'required|min:4',
    ];

    public function __construct(Request $request)
    {
        $this->scenario($request);
    }

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
        return $this->rules;
    }

    public function messages()
    {
        return [
            'name.min'                           => 'Имя должно быть не меньше 4-х символов.',
            'email.required'                     => 'E-mail не должен быть пустым.',
            'name.required'                      => 'Имя не должно быть пустым.',
            'password.required'                  => 'Пароль не должен быть пустым.',
            'password_confirmation'              => 'Необходимо подтвердить пароль.',
            'new_password.required'              => 'Новый пароль не должен быть пустым.',
            'new_password.confirmed'             => 'Новый пароль не совпадает с подтверждённым паролем.',
            'new_password_confirmation.required' => 'Необходимо подтвердить новый пароль.',
        ];
    }

    public function scenario($request)
    {
        if ( ! is_null($request->get('password')) && $request->get('id')) {
            $this->rules();
        } elseif (is_null($request->get('id'))) {
            $this->rules = array_except($this->rules, ['new_password', 'new_password_confirmation']);
            $this->rules();
        } else {
            $this->rules = array_except($this->rules, ['password', 'password_confirmation', 'new_password', 'new_password_confirmation']);
            $this->rules();
        }
    }
}
