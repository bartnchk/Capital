<?php

namespace App\Filters;

//use App\User;


use App\Models\Admin\Region;
use App\Models\Common\City;
use Illuminate\Support\Facades\DB;

class NewsFilters extends Filters
{
    protected $filters = ['city', 'region', 'national'];

    /**
     * @param $builder
     */
    protected function city($id)
    {
        $city = City::where('id', $id)->firstOrFail();

        return $this->builder->where('city_id', $city->id);


        return $this->builder->where('id', $id);
    }

    protected function region($id)
    {
        $ids = [];

        $cities = DB::table('cities')
            ->join('regions', 'regions.id', '=', 'cities.region_id')
            ->select('cities.id')
            ->where('regions.id', $id)
            ->get();

        //dd($cities);

        foreach ($cities as $city){
            $ids[] = $city->id;
        }

        return $this->builder->whereIn('', $ids);
    }

    protected function national()
    {
        //return $this->builder->where('region_id', null);
    }
}