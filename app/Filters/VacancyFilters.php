<?php

namespace App\Filters;


use App\Models\Common\City;
use App\Models\Common\VacancyCategory;

class VacancyFilters extends Filters
{
    protected $filters = ['city', 'category', 'national'];

    /**
     * @param $builder
     */
    protected function city($id)
    {
        $city = City::where('id', $id)->firstOrFail();

        return $this->builder->where('city_id', $city->id);
    }

    protected function category($id)
    {
        $category = VacancyCategory::where('id', $id)->firstOrFail();

        return $this->builder->where('category_id', $category->id);
    }

    protected function national()
    {
        return ;
    }
}