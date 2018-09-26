<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Region;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegionController extends Controller
{
    public function index()
    {
        $regions = Region::paginate(20);

        return view('admin.regions.index', ['regions' => $regions]);
    }

    public function edit($id)
    {
        $region = Region::findOrFail($id);

        return view('admin.regions.edit', ['region' => $region]);

    }

    public function update(Request $request)
    {
        $region = Region::findOrFail($request->get('id'));

        if ($region->update($request->all())) {
            return redirect('admin/regions')->with(['message' => 'Регион сохранён', 'class' => 'success']);
        }


        return redirect('admin/regions')->with('error', 'Ошибка');
    }

    public function create()
    {
        $region = new Region();

        return view('admin.regions.edit', ['region' => $region]);

    }

    public function store(Request $request)
    {
        $region = new Region();
        $region->fill($request->all());
        if ($region->save()) {
            return redirect('admin/regions')->with(['message' => 'Регион сохранён', 'class' => 'success']);
        }
    }

    public function destroy($id)
    {
        if ( is_array($id) )
        {
            $region = Region::whereIn('id', $id);
        }
        else
        {
            $region = Region::find($id);
        }

        if( $region->delete() )
        {
            return response()->json(["class" => "success", "message" => 'Регион удален'], 200);
        }
    }

    public function destroyAll(Request $request)
    {
        if ($request->regions && count($request->regions) )
        {
            $this->destroy($request->regions);
            return back()->with(['message' => 'Регионы удалены', 'class' => 'success']);
        }
    }
}
