<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title_ru' => 'required',
            'title_uk' => 'required',
            'description_ru' => 'required',
            'description_uk' => 'required',
            'photo' => 'image|mimes:jpeg,bmp,png,jpg|max:5000',
        ];
    }

    public function messages()
    {
        return [
            'title_ru.required' => 'Необходимо указать заголовок!',
            'title_uk.required' => 'Необходимо указать заголовок для украинской версии!',
            'description_ru.required' => 'Необходимо заполнить описание!',
            'description_uk.required' => 'Необходимо заполнить описание для украинской версии!',
            'photo.required' => 'Необходимо выбрать изображение',
            'photo.mimes' => 'Допустимые форматы загрузки излбражения: jpeg, bmp, png!',
            'photo.max' => 'Допустимый размер файла 5мб !',
        ];
    }
}
