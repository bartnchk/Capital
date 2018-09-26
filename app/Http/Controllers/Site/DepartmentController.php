<?php

namespace App\Http\Controllers\Site;

use App\Filters\DepartmentsFilters;
use App\Models\Common\City;
use App\Models\Common\Office;
use App\Http\Controllers\Controller;

class DepartmentController extends Controller
{
    public function index()
    {
        $cities = City::published()->get();

        return view('site.departments.index', ['cities' => $cities]);
    }

    public function show($id)
    {
        $department = Office::published()->whereNumber($id)->firstOrFail();

        return view('site.departments.show', ['department' => $department]);

    }

    protected function getDepartments(DepartmentsFilters $filters)
    {
        if ($filters->getFilters()) {
            $departments = Office::filter($filters)->orderBy('created_at', 'DESC');
        } else {
            $departments = Office::published()->orderBy('created_at', 'DESC');
        }
        $departments_filtered = $departments->get([
            'id',
            'number',
            'city_id',
            'address_' . app()->getLocale(),
            'phone',
            'image',
            'work_days_' . app()->getLocale(),
            'time_start',
            'time_end',
            'lat',
            'lng'
        ])->toArray();


        return response()->json($departments_filtered, '200');
    }
}
