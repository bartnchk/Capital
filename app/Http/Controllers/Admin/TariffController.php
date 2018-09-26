<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\TariffRequest;
use App\Models\Common\Tariff;
use App\Models\Admin\TariffCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TariffController extends Controller
{
    public function index(Request $request)
    {
        $paginate = 15;
        $page = $request->has('page') ? $request->page*$paginate-$paginate : 0;
        $tariffs = Tariff::published()->with('category')->paginate($paginate);

        return view('admin.tariffs.index', compact('tariffs', 'page'));
    }

    public function create()
    {
        $categories = TariffCategory::published()->get();
        return view('admin.tariffs.create', compact('categories'));
    }

    public function edit($id)
    {
        $tariff = Tariff::findOrFail($id);
        $categories = TariffCategory::published()->get();

        return view('admin.tariffs.create', compact('tariff', 'categories'));
    }

    public function store(TariffRequest $request)
    {
        $tariff = new Tariff;

        $this->saveTariff($request, $tariff);

        return redirect()->route('tariffs.index')
            ->with(['message' => 'Тариф сохранён', 'class' => 'success']);
    }

    public function update(TariffRequest $request, $id)
    {
        $tariff = Tariff::findOrFail($id);

        $this->saveTariff($request, $tariff);

        return redirect()->route('tariffs.index')
            ->with(['message' => 'Тариф сохранён', 'class' => 'success']);
    }

    private function saveTariff(TariffRequest $request, $tariff)
    {
        $input = $request->except('_token', '_method', 'url');

        if ($request->has('image')) {

            $tariff->deleteImage($tariff->image, 'tariffs');

            $input['image'] = $tariff->saveImage($request->image, 'tariffs', 316, 184);
        } else {
            $input['image'] = $tariff->image;
        }

        $tariff->fill($input);
        $tariff->save();
    }

    public function destroyAll(Request $request)
    {
        if($request->tariffs && count($request->tariffs)){

            Tariff::destroy($request->tariffs);

            return redirect()->route('tariffs.index')
                ->with(['message' => 'Тарифы удалены', 'class' => 'success']);
        } else {
            return back()->with(['message' => 'Не выбрано ни одного тарифа', 'class' => 'warning']);
        }

    }
    public function destroy( Tariff $tariff ) {

        if ($tariff->delete()){
            return response()->json( [
                "class" => "success", "message" => 'Тариф удален'
            ] );
        }
    }
}
