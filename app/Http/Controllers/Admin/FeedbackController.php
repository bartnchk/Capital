<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\FeedRequest;
use App\Models\Admin\Region;
use App\Models\Common\Feedback;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    protected $feedback;
    protected $regions;

    public function __construct()
    {
        $this->feedback = new Feedback();
        $this->regions = Region::published()->get();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.feedbacks.create', ['feedback' => $this->feedback, 'regions' => $this->regions]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $feedbacks = Feedback::paginate(20);
        return view('admin.feedbacks.index', ['feedbacks' => $feedbacks]);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $feedback = Feedback::findOrFail($id);

        return view('admin.feedbacks.create', ['feedback' => $feedback, 'regions' => $this->regions]);
    }

    /**
     * @param FeedRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(FeedRequest $request)
    {


        $this->feedback->fill($request->except('_method', '_token'));

        if ($this->feedback->save())
        {
            return redirect('admin/feedbacks')->with(['message' => 'Отзыв сохранён', 'class' => 'success']);
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        if (is_array($id))
        {
            $feedback = Feedback::whereIn('id', $id);
        }
        else
        {
            $feedback = Feedback::find($id);
        }

        if($feedback->delete())
        {
            return response()->json(['message' => 'Отзыв удалён', 'class' => 'success'], 200);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroyAll(Request $request)
    {
        if ($request->feedbacks && count($request->feedbacks)){
            $this->destroy($request->feedbacks);
            return back()->with(['message' => 'Отзывы удалены', 'class' => 'success']);
        }
    }

    public function update(FeedRequest $request, $id)
    {
        $feedback = Feedback::findOrFail($id);
        $feedback->fill( $request->all() )->save();

        return redirect('admin/feedbacks')->with(['message' => 'Отзыв сохранён', 'class' => 'success']);
    }
}
