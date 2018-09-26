<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FeedRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|min:2',
            'body' => 'required|min:5',
            'city' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Не заполнено Имя',
            'name.min'      => 'Имя не может быть меньше двух символов',
            'region_id.required' => 'Выберите регион',
            'city_id.required' => 'Не заполнен город',
            'body.required' => 'Поле "Отзыв" не может быть пустым',
            'body.min'      => 'Слишком короткий отзыв'
        ];
    }
}
