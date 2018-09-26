<?php

namespace App\Http\Controllers\Admin;

use App\Models\Common\FaqCategory;
use App\Http\Requests\CommonRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FaqCategoryController extends Controller
{
    public function index(Request $request)
    {
        $paginate = 15;
        $categories = FaqCategory::paginate($paginate);
        $page = $request->has('page') ? $request->page*$paginate-$paginate : 0;

        return view('admin.faq_categories.index', compact('categories', 'page'));
    }

    public function create()
    {
        return view('admin.faq_categories.create');
    }

    public function edit($id)
    {
        $category = FaqCategory::findOrFail($id);

        return view('admin.faq_categories.create', compact('category'));
    }

    public function store(CommonRequest $request)
    {
        $input = $request->except('_token', '_method');
        $input['alias'] = $request->alias ? $request->alias : str_slug($request->title_ru);

        FaqCategory::create($input);

        return redirect()->route('faq_categories.index')
            ->with(['message' => 'Категория сохранена', 'class' => 'success']);
    }

    public function update(CommonRequest $request, $id)
    {
        $input = $request->except('_token', '_method');
        $input['alias'] = $request->alias ? $request->alias : str_slug($request->title_ru);

        FaqCategory::where('id', $id)->update($input);

        return redirect()->route('faq_categories.index')
            ->with(['message' => 'Категория сохранена', 'class' => 'success']);
    }

    public function destroy( $id)
    {
        $filledCategories = [];

        $category = FaqCategory::with('faqs')->find($id);
        if (count($category->faqs)){
            $filledCategories[] = $category->title_ru;
        } else {
            $category->delete();
        }
        if (count($filledCategories)){
            return response()->json( [
                "message" => 'Категория '.implode(' ', $filledCategories).' содержит вопросы, Вы не можете ее удалить.',
                "class" => "danger"
            ] );
        }
        return response()->json( [
            "class" => "success", "message" => 'Категория удалена'
        ] );
    }

    public function destroyAll(Request $request)
    {
        if($request->categories && count($request->categories)){
            $filledCategories = [];
            foreach ($request->categories as $category){
                $category = FaqCategory::with('faqs')->find($category);
                if (count($category->faqs)){
                    $filledCategories[] = $category->title_ru;
                } else {
                    $category->delete();
                }
            }
            if (count($filledCategories)){
                return redirect()->route( 'faq_categories.index' )
                    ->with( ['message' => 'Категория '.implode(' ', $filledCategories).' содержит вопросы, Вы не можете ее удалить.', 'class' => 'warning'] );
            }
            return redirect()->route('faq_categories.index')
                ->with(['message' => 'Категории удалены', 'class' => 'success']);
        } else {
            return back()->with(['message' => 'Не выбрано ни одной категории', 'class' => 'warning']);
        }
    }
}
