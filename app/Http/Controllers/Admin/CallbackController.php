<?php

namespace App\Http\Controllers\Admin;

use App\Models\Common\Callback;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CallbackController extends Controller
{
    public function index(Request $request)
    {
        $paginate = 15;
        $page = $request->has('page') ? $request->page*$paginate-$paginate : 0;
        $callbacks = Callback::paginate($paginate);
        Carbon::setLocale('ru');

        return view('admin.callbacks.index', compact('callbacks', 'page'));
    }

    public function update($id)
    {
        Callback::findOrFail($id)->toggle()->save();

        return response()->json( [
            "class" => "success", "message" => 'Статус изменен.'
        ] );
    }

    public function destroyAll(Request $request)
    {
        if( $request->callbacks && count($request->callbacks)){

            Callback::destroy($request->callbacks);

            return redirect()->route('callbacks.index')
                ->with(['message' => 'Заявки удалены.', 'class' => 'success']);
        } else {
            return back()->with(['message' => 'Не выбрано ни одной заявки', 'class' => 'warning']);
        }

    }
    public function destroy( $id ) {

        $banner = Callback::findOrFail($id);

        if ($banner->delete()){
            return response()->json( [
                "class" => "success", "message" => 'Заявка удалена.'
            ] );
        }
    }
}
