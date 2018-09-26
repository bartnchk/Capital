<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Region;
use App\Models\Common\City;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CityController extends Controller
{
    public function index()
    {
        $cities = City::paginate(20);

        return view('admin.cities.index', ['cities' => $cities]);
    }

    public function edit($id)
    {
        $city = City::findOrFail($id);
        $regions = Region::all();
        return view('admin.cities.edit', ['city' => $city, 'regions' => $regions]);

    }

    public function update(Request $request)
    {
        $cities = City::findOrFail($request->get('id'));

        if ($cities->update($request->all())) {
            return redirect('admin/cities')->with(['message' => 'Город сохранён', 'class' => 'success']);
        }


        return redirect('admin/cities')->with('error', 'Ошибка');
    }

    public function create()
    {
        $city = new City();
        $regions = Region::all();

        return view('admin.cities.edit', ['city' => $city,  'regions' => $regions]);

    }

    public function store(Request $request)
    {
        $cities = new City();
        $cities->fill($request->all());
        if ($cities->save()) {
            return redirect('admin/cities')->with(['message' => 'Город сохранён', 'class' => 'success']);
        }
    }

    public function destroy($id)
    {
        if (is_array($id)) {
            $city = City::whereIn('id', $id);
        }
        else{
            $city = City::find($id);
        }
        if($city->delete()){
            return response()->json(["class" => "success", "message" => 'Город удален'], 200);
        }
    }

    public function destroyAll(Request $request)
    {
        if ( $request->cities && count($request->cities) )
        {
            $this->destroy($request->cities);
            return back()->with(['message' => 'Города удалены', 'class' => 'success']);
        }
    }

    public function getCities(Request $request)
    {
        return City::where('region_id', $request->get('id'))->get();
    }
}
