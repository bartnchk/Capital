<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MainRequest extends FormRequest
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

    public function rules()
    {
        return [
            'title_ru' => 'required',
            'title_uk' => 'required',
            'description_ru' => 'sometimes|required',
            'description_uk' => 'sometimes|required',
            'faq_category_id' => 'sometimes|required',
            'link' => 'sometimes|required',
//            'image' => 'mimes:jpeg,bmp,png|max:5000',
        ];
    }

    public function messages()
    {
        return [
            'title_ru.required' => 'Необходимо указать заголовок!',
            'title_uk.required' => 'Необходимо указать заголовок для украинской версии!',
            'description_ru.required' => 'Необходимо заполнить описание!',
            'description_uk.required' => 'Необходимо заполнить описание для украинской версии!',
            'faq_category_id.required' => 'Необходимо выбрать категорию!',
            'link.required' => 'Необходимо добавить ссылку!',
//            'image.required' => 'Необходимо выбрать изображение изображени',
            'image.mimes' => 'Допустимые форматы загрузки излбражения: jpeg, bmp, png !',
            'image.image' => 'Изображение долно быть изображением.',
            'image.max' => 'Допустимый размер файла 5мб !',
            'documents.mimes' => 'Допускается только загрузка pdf и doc файлов',
            'documents.file' => 'Неудачная загрузка файлов',
            'documents.max' => 'Большой размер файла'
        ];
    }
}
