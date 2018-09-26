<?php

namespace App\Filters;

use App\Models\Common\City;
use App\Models\Common\Office;

class DepartmentsFilters extends Filters
{
    protected $filters = ['city', 'department', 'national'];

    /**
     * @param $builder
     */

    protected function city($id)
    {
        $city = City::where('id', $id)->firstOrFail();

        return $this->builder->where('city_id', $city->id);
    }

    protected function department($id)
    {
        $department = Office::where('id', $id)->firstOrFail();

        return $this->builder->where('id', $department->id);
    }

    protected function national()
    {
        return;
    }
}