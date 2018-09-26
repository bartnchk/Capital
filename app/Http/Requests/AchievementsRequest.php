<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AchievementsRequest extends FormRequest
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
            'years' => 'required|integer',
            'offices' => 'required|integer',
            'cities' => 'required|integer',
            'clients' => 'required|integer',
            'credits' => 'required|integer',
        ];
    }
}
