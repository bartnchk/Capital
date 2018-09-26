<?php

namespace App\Http\Controllers\Site;

use App\Models\Common\Faq;
use App\Models\Common\FaqCategory;
use App\Http\Controllers\Controller;
use App\Models\Common\Seo;

class FaqController extends Controller
{
    public function index()
    {
        $meta_tags = Seo::whereAlias('faq')->first();
        $all_faqs = Faq::with('category')->orderBy('faq_category_id')->get();
        $categories = FaqCategory::with('faqs')->get();


        return view('site.faqs.index', compact('all_faqs', 'categories', 'meta_tags'));

    }
}
