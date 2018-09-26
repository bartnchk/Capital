<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ActionRequest;
use App\Models\Admin\Action;
use App\Models\Admin\Region;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ActionController extends Controller
{
    protected $action;
    protected $regions;

    /**
     * ActionController constructor.
     */
    public function __construct()
    {
        $this->action = new Action;
        $this->regions = Region::published()->get();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $elemsOnPage = 10;
        $request->page = $request->page ? $request->page : 1;

        $counter = $request->page * $elemsOnPage - $elemsOnPage;
        $actions = Action::paginate($elemsOnPage);
        return view('admin.actions.index', ['actions' => $actions, 'counter' => $counter]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.actions.create', ['action' => $this->action, 'regions' => $this->regions]);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $action = Action::findOrFail($id);

        $cities = $action->getUnionTable();

        return view('admin.actions.create', ['action' => $action, 'regions' => $this->regions, 'cities' => $cities]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ActionRequest $request)
    {
        $requestData = $request->all();

        $result = $this->action->saveAction($requestData, $request);

        if($result)
            return redirect('admin/actions')->with(['message' => 'Акция сохранена', 'class' => 'success']);
        else
            return redirect('admin/actions')->with(['message' => 'При сохранении возникла ошибка', 'class' => 'error']);
    }

    /**
     * @param Action $action
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Action $action)
    {
        if ( $action->delete() )
        {
            return response()->json( ['message' => 'Акция удалена', 'class' => 'success'] );
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroyAll(Request $request)
    {
        if( $request->actions && count($request->actions) ){

            $this->action->destroy($request->actions);

            return redirect('admin/actions')->with(['message' => 'Акции удалены.', 'class' => 'success']);

        } else {

            return back()->with(['message' => 'Не выбрано ни одной акции', 'class' => 'warning']);

        }
    }

    /**
     * @param ActionRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ActionRequest $request, $id)
    {
        $requestData = $request->all();

        $this->action = $this->action->findOrFail($id);

        $result = $this->action->saveAction($requestData, $request);

        if($result)
            return redirect($request->url)->with(['message' => 'Акция сохранена', 'class' => 'success']);
        else
            return redirect($request->url)->with(['message' => 'Акция сохранена', 'class' => 'error']);
    }

    public function deleteImage(Request $request)
    {
        $this->action->deleteImage( $request->get('src') );
    }
}
