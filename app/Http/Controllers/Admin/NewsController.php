<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CommonRequest;
use App\Models\Admin\News;
use App\Models\Admin\Region;
use App\Models\Common\Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewsController extends Controller
{
    private $paginate = 15;

    public function index(Request $request)
    {
        $page = $request->has('page') ? $request->page*$this->paginate-$this->paginate : 0;

        if ($request->has('q')){
            $news = News::where('title_ru', 'like', "%{$request->q}%")
                ->orWhere('title_uk', 'like', "%{$request->q}%")
                ->with('region', 'city')
                ->paginate($this->paginate);
        } else {
            $news = News::with('region', 'city')->latest()->paginate($this->paginate);
        }
        return view('admin.news.index', compact('news', 'page'));
    }

    public function create()
    {
        $regions = Region::published()->get();

        return view('admin.news.create', compact('regions'));
    }

    public function edit($id)
    {
        $news = News::findOrFail($id);
        $regions = Region::published()->get();
        $cities = $news->city;

        return view('admin.news.create', compact('news', 'regions', 'cities'));
    }

    public function store(CommonRequest $request)
    {
        $news = new News;

        $this->saveNews($request, $news);

        $news->storeUnionTable($request);

        return redirect()->route('news.index')
            ->with(['message' => 'Новость сохранена', 'class' => 'success']);
    }

    public function update(CommonRequest $request, $id)
    {
        $news = News::find($id);

        $marked = $this->saveNews($request, $news);

        $news->storeUnionTable($request, true);

        if (basename($request->url) == 'login'){
            return redirect()->route('news.index')
                ->with(['message' => 'Новость сохранена', 'class' => 'success', 'marked' => $marked->id]);
        }
        return redirect($request->url)
            ->with(['message' => 'Новость сохранена', 'class' => 'success', 'marked' => $marked->id]);
    }

    private function saveNews($request, $news)
    {
        $input = $request->except('_token', '_method', 'images', 'url', 'region_id', 'city_id');
        $input['alias'] = $request->alias ? $request->alias : str_slug($request->title_ru);
        if ($request->has('image')) {

            $news->deleteImage($news->image, 'news');

            $input['image'] = $news->saveWithThumbnail($request->image, 'news', 650, 500, 418, 243);
        } else {
            $input['image'] = $news->image;
        }
        if ($request->has('image_small')) {

            $news->deleteImage($news->image_small, 'news');

            $input['image_small'] = $news->saveImage($request->image_small, 'news', 418, 243);
        } else {
            $input['image_small'] = $news->image_small;
        }

        $news->fill($input);
        $news->save();

        if ($request->has('images')){
            foreach ($request->images as $image){
                // создали картинку, запись на диск, возвращает filename.jpeg
                $imageName = $news->saveWithThumbnail($image, 'news', 1300, 1000, 276, 212);
                // создали запись в таблице images
                $news->addImage($imageName);
            }
        }
        return $news;
    }

    public function destroyAll(Request $request)
    {
        if($request->news && count($request->news)){

            News::destroy($request->news);

            return redirect()->route('news.index')
                ->with(['message' => 'Новости удалены', 'class' => 'success']);
        } else {
            return back()->with(['message' => 'Не выбрано ни одной новости', 'class' => 'warning']);
        }
    }
    public function destroy( News $news ) {

        if ($news->delete()){
            return response()->json( [
                "class" => "success", "message" => 'Новость удалена'
            ] );
        }
    }
}
