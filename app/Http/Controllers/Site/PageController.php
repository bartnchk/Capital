<?php

namespace App\Http\Controllers\Site;

use App\Models\Admin\CreditStep;
use App\Models\Admin\Main\Youget;
use App\Models\Admin\Page;
use App\Models\Common\Achievement;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    public function show($page)
    {
        $pages = Page::pluck('alias')->all();

        if (!in_array($page, $pages)){
            return redirect()->route('404');
        }
        $view = $page;
//        if ($view == 'about'){
//            $yougets = Youget::all();
//            $achievements = Achievement::first();
//            $page = Page::where('alias', $page)->with(['images' => function($query) {
//                $query->take(5);
//            }])->first();
//            return view('site.pages.'.$view, compact('page','achievements', 'yougets'));
//        } else {
//            $page = Page::where('alias', $page)->first();
//        }
        switch ($view) {
            case 'about':
                $yougets = Youget::all();
                $achievements = Achievement::first();
                $page = Page::where('alias', $page)->with(['images' => function($query) {
                    $query->take(5);
                }])->first();
                return view('site.pages.'.$view, compact('page','achievements', 'yougets'));
                break;
            case 'get-credit':
                $steps = CreditStep::published()->get();
        }
        $page = Page::where('alias', $page)->first();

        return view('site.pages.'.$view, compact('page', 'steps'));
    }
}

