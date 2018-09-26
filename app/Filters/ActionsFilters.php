<?php

namespace App\Filters;


use App\Models\Admin\Action;
use Illuminate\Support\Facades\DB;

class ActionsFilters extends Filters
{
    protected $filters = ['city', 'archive'];

    /**
     * @param $builder
     */
    protected function city($id)
    {
        $ids = [];
        $cities = DB::table('union_actions')
                  ->leftJoin('actions', 'actions.id', '=', 'union_actions.action_id')
                  ->select('actions.*')
                  ->where('union_actions.city_id', $id)
                  ->get();

        foreach ($cities as $city){
            $ids[] = $city->id;
        }

        return $this->builder->whereIn('id', $ids);
    }

    protected function archive($date)
    {
        $action = Action::whereYear('created_at', '=', date('Y' , strtotime($date)))->whereMonth('created_at', '=', date('m' , strtotime($date)))->firstOrFail();

        return $this->builder->whereYear('created_at', '=', date('Y' , strtotime($action->created_at)))->whereMonth('created_at', '=', date('m' , strtotime($action->created_at)));
    }

    protected function national()
    {
        return ;
    }
}