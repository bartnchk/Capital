<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CommonRequest;
use App\Models\Admin\Page;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::with('images')->get();

        return view('admin.pages.index', compact('pages'));
    }

    public function edit($id)
    {
        $page = Page::findOrFail($id);

        return view('admin.pages.create', compact('page'));
    }

    public function update(CommonRequest $request, $id)
    {
        $input = $request->except('_token', '_method', 'images');

        $page = Page::findOrFail($id);

        if ($request->has('image')) {

            $page->deleteImage($page->image, 'page');

            $input['image'] = $page->saveImage($request->image, 'page', 642, 500);
        } else {
            $input['image'] = $page->image;
        }

        $page->update($input);

        if ($request->has('images')){
            foreach ($request->images as $image){
                // создали картинку, запись на диск, возвращает filename.jpeg
                $imageName = $page->saveWithThumbnail($image, 'page', 1300, 1000, 642, 500);
                // создали запись в таблице images
                $page->addImage($imageName);
            }
        }

        return redirect()->route('pages.index')
            ->with(['message' => 'Страница отредактирована.', 'class' => 'success']);
    }

}
