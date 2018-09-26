<?php

namespace App\Http\Controllers\Admin;

use App\Models\Common\Seo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SeoController extends Controller
{
    public function index()
    {
        $pages = Seo::all();

        return view('admin.seo.index', compact('pages'));
    }

    public function edit($id)
    {
        $page = Seo::findOrFail($id);

        return view('admin.seo.edit', compact('page'));
    }

    public function update(Request $request, $id)
    {
        $input = $request->except('_token', '_method');

        $page = Seo::findOrFail($id);

        $page->update($input);

        return redirect()->route('seo.index')
            ->with(['message' => 'Страница отредактирована.', 'class' => 'success']);
    }
}
