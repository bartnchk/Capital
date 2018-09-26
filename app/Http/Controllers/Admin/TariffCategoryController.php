<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CommonRequest;
use App\Models\Admin\TariffCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TariffCategoryController extends Controller
{
    public function index(Request $request)
    {
        $paginate = 10;
        $page = $request->has('page') ? $request->page*$paginate-$paginate : 0;
        $categories = TariffCategory::paginate($paginate);

        return view('admin.tariff_categories.index', compact('categories', 'page'));
    }

    public function create()
    {
        return view('admin.tariff_categories.create');
    }

    public function edit($id)
    {
        $category = TariffCategory::findOrFail($id);

        return view('admin.tariff_categories.create', compact('category'));
    }

    public function store(CommonRequest $request)
    {
        $category = new TariffCategory;

        $this->saveTariffCategory($request, $category);

        return redirect()->route('tariff_categories.index')
            ->with(['message' => 'Категория сохранена', 'class' => 'success']);
    }

    public function update(CommonRequest $request, $id)
    {
        $category = TariffCategory::findOrFail($id);

        $this->saveTariffCategory($request, $category);

        return redirect()->route('tariff_categories.index')
            ->with(['message' => 'Категория сохранена', 'class' => 'success']);
    }

    private function saveTariffCategory(CommonRequest $request, $category)
    {
        $input = $request->except('_token', '_method');
        $input['alias'] = $request->alias ? $request->alias : str_slug($request->title_ru);
        $category->fill($input);
        $category->save();
    }

    public function destroy( $id)
    {
        $filledCategories = [];

        $category = TariffCategory::with('tariffs')->find($id);
        if (count($category->tariffs)){
            $filledCategories[] = $category->title_ru;
        } else {
            $category->delete();
        }
        if (count($filledCategories)){
            return response()->json( [
                "class" => "warning",
                "message" => 'Категория '.implode(' ', $filledCategories).' содержит тарифы, Вы не можете ее удалить.'
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
                $category = TariffCategory::with('tariffs')->findOrFail($category);
                if (count($category->tariffs)){
                    $filledCategories[] = $category->title_ru;
                } else {
                    $category->delete();
                }
            }
            if (count($filledCategories)){
                return redirect()->route( 'tariff_categories.index' )
                    ->with( ['message' => 'Категория '.implode(' ', $filledCategories).' содержит тарифы, Вы не можете ее удалить.', 'class' => 'warning'] );
            }
            return redirect()->route('tariff_categories.index')
                ->with(['message' => 'Категории удалены', 'class' => 'success']);
        } else {
            return back()->with(['message' => 'Не выбрано ни одной категории', 'class' => 'warning']);
        }

    }


}
