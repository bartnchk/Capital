<?php

namespace App\Http\Controllers\Site;

use App\Models\Admin\News;
use App\Models\Admin\Region;
use App\Models\Common\City;
use App\Models\Common\Seo;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


class NewsController extends Controller
{
    public function index(Request $request)
    {
        $current_region = null;

        $meta_tags = Seo::whereAlias('news')->first();

        if ($request->has('city'))
        {
            $news = City::findOrFail($request->city)->news();
            $current_region = Region::findOrFail($request->region);
        }
        elseif($request->has('region'))
        {
            $news = Region::findOrFail($request->region)->news();
            $current_region = Region::findOrFail($request->region);
        }
        else
        {
            $news = News::published()->latest();
        }

        $current_national = $request->has('national') ? 1 : null;

        $regions = Region::published()->get();
        $request = $request->only('region', 'city', 'national');

        $news = $news->paginate(12);

        return view('site.news.index',
            compact('news', 'request', 'regions', 'current_region', 'current_national', 'month', 'meta_tags'));
    }

    public function show($news)
    {
        $news = News::whereAlias($news)->firstOrFail();

        return view('site.news.item', compact('news'));

    }
}
