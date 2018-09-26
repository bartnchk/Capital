<?php

namespace App\Http\Controllers\Site;

use App\Filters\VacancyFilters;
use App\Models\Common\City;
use App\Models\Common\Seo;
use App\Models\Common\Vacancy;
use App\Http\Controllers\Controller;
use App\Models\Common\VacancyCategory;
use Symfony\Component\HttpFoundation\Request;

class VacancyController extends Controller
{
    public function index(VacancyFilters $filters, Request $request)
    {
        $meta_tags = Seo::whereAlias('vacancy')->first();
        $cities     = City::published()->get();
        $categories = VacancyCategory::published()->get();
        $request    = $request->only('city', 'category');
        $vacancies  = $this->getVacancies($filters);

        return view('site.vacancies.index',
            ['vacancies' => $vacancies, 'cities' => $cities, 'categories' => $categories, 'request' => $request, 'meta_tags' => $meta_tags]);
    }

    protected function getVacancies(VacancyFilters $filters)
    {
        if ($filters->getFilters()) {
            $news = Vacancy::filter($filters)->orderBy('created_at', 'DESC');
        } else {
            $news = Vacancy::published()->orderBy('created_at', 'DESC');
        }
        return $news->paginate(10);
    }
}
