<?php

namespace App\Http\Controllers\Admin;

use App\Models\Common\Subscriber;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubscriberController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $subscribers = Subscriber::paginate(20);
        return view('admin.subscribers.index', ['subscribers' => $subscribers]);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        if ( is_array($id) )
            $subscriber = Subscriber::whereIn('id', $id);
        else
            $subscriber = Subscriber::find($id);

        if( $subscriber->delete() )
            return response()->json(['message' => 'Подписчик удалён', 'class' => 'success'], 200);

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroyAll(Request $request)
    {
        if ($request->subscribers && count($request->subscribers))
        {
            $this->destroy($request->subscribers);
            return back()->with(['message' => 'Подписчики удалены', 'class' => 'success']);
        }
        else
        {
            return back()->with(['message' => 'Не выбрано ни одного подписчика', 'class' => 'warning']);
        }
    }
}
