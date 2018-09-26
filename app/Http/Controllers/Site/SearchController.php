<?php

namespace App\Http\Controllers\Site;

use App\Models\Admin\Action;
use App\Models\Admin\News;
use App\Models\Common\Seo;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function index(\App\Search\SearchRepository $repository)
    {
        $meta_tags = Seo::whereAlias('search')->first();
        if (request('q')) {
            $all = $repository->search(request('q'));
        } else {
            $all = new Collection;
        }
        $model = $this->paginateCollection($all, 20, $pageName = 'page', $fragment = null);

        return view('site.search.index', ['results' => $model, 'meta_tags' => $meta_tags]);

    }

    function paginateCollection($collection, $perPage, $pageName = 'page', $fragment = null)
    {
        $currentPage = \Illuminate\Pagination\LengthAwarePaginator::resolveCurrentPage($pageName);
        $currentPageItems = $collection->slice(($currentPage - 1) * $perPage, $perPage);
        parse_str(request()->getQueryString(), $query);
        unset($query[$pageName]);
        $paginator = new \Illuminate\Pagination\LengthAwarePaginator(
            $currentPageItems,
            $collection->count(),
            $perPage,
            $currentPage,
            [
                'pageName' => $pageName,
                'path' => \Illuminate\Pagination\LengthAwarePaginator::resolveCurrentPath(),
                'query' => $query,
                'fragment' => $fragment
            ]
        );
        return $paginator;
    }
}
