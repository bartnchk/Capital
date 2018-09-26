<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VacancyRequest extends FormRequest
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
            'title_ru' => 'required|max:255',
            'description_ru' => 'required|max:2550',
            'title_uk' => 'required|max:255',
            'description_uk' => 'required|max:2550',
            'category_id' => 'required|integer',
            'region_id' => 'required|integer',
            'city_id' => 'required|integer'
        ];
    }

    public function messages()
    {
        return [
            'title_ru.required' => 'Заголовок не должен быть пустым!',
            'description_ru.required' => 'Описание не должно быть пустым!',
            'title_uk.required' => 'Заголовок не должен быть пустым!',
            'description_uk.required' => 'Описание не должно быть пустым!',
            'category_id.required' => 'Выберите категорию!',
            'region_id.required' => 'Выберите область!',
            'city_id.required' => 'Выберите город!'
        ];
    }
}
