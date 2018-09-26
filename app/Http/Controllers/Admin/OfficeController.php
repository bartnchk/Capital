<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\OfficeRequest;
use App\Models\Admin\Region;
use App\Models\Common\City;
use App\Models\Common\Office;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OfficeController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('q')){
            $offices = Office::where('number', 'like', "%{$request->q}%")
                ->paginate(20);
        } else {
            $offices = Office::orderBy('number')->paginate(20);
        }

        return view('admin.offices.index', ['offices' => $offices]);
    }

    public function edit($id)
    {
        $office  = Office::findOrFail($id);
        $regions = Region::published()->get();

        return view('admin.offices.edit', ['office' => $office, 'regions' => $regions]);

    }

    public function update(OfficeRequest $request)
    {
        $office = Office::findOrFail($request->get('id'));

        $marked = $this->saveOffice($request , $office);

        return redirect('admin/offices')->with(['message' => 'Отделение сохранено', 'class' => 'success', 'marked' => $marked->id]);
    }

    public function create()
    {
        $office  = new Office();
        $regions = Region::published()->get();

        return view('admin.offices.edit', ['office' => $office, 'regions' => $regions]);

    }

    public function store(OfficeRequest $request)
    {
        $office = new Office();
        $this->saveOffice($request , $office);

        return redirect('admin/offices')->with(['message' => 'Отделение сохранено', 'class' => 'success']);
    }

    public function destroy($id)
    {
        if (is_array($id)) {
            $office = Office::whereIn('id', $id);
        } else {
            $office = Office::find($id);
        }
        if ($office->delete()) {
            return response()->json(['message' => 'Отделение удалено', 'class' => 'success'], 200);
        }
    }


    public function destroyAll(Request $request)
    {
        if ($request->offices && count($request->offices)) {
            $this->destroy($request->offices);

            return back()->with(['message' => 'Отделения удалены', 'class' => 'success']);
        }
    }

    private function saveOffice($request, $office)
    {
        $input = $request->except('_token', '_method', 'images');
        if ($request->has('image')) {
            $office->deleteImage($office->image, 'offices');

            $input['image'] = $office->saveImage($request->image, 'offices', 300, 254);
        } else {
            $input['image'] = $office->image;
        }

        $office->fill($input);
        $office->save();

        if ($request->has('images')) {
            foreach ($request->images as $image) {
                // создали картинку, запись на диск, возвращает filename.jpeg
                $imageName = $office->saveWithThumbnail($image, 'offices', 900, 762, 300, 254);
                // создали запись в таблице images
                $office->addImage($imageName);
            }
        }
        return $office;
    }


    public function getCities(Request $request)
    {
        if (is_array($request->get('id'))){
            return City::whereIn('region_id', $request->get('id'))->get();
        }else{
            return City::where('region_id', $request->get('id'))->get();
        }
    }
}
