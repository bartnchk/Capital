<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\CreditStep;
use App\Http\Requests\CommonRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CreditStepController extends Controller
{
    public function index(Request $request)
    {
        $paginate = 15;
        $steps = CreditStep::paginate($paginate);
        $page = $request->has('page') ? $request->page*$paginate-$paginate : 0;


        return view('admin.credit_steps.index', compact('steps', 'page'));
    }

    public function create()
    {
        return view('admin.credit_steps.create', compact('categories'));
    }

    public function edit($id)
    {
        $step = CreditStep::findOrFail($id);

        return view('admin.credit_steps.create', compact('step'));
    }

    public function store(CommonRequest $request)
    {
        CreditStep::create($request->except('_token'));

        return redirect()->route('steps.index')
            ->with(['message' => 'Шаг сохранен', 'class' => 'success']);
    }

    public function update(CommonRequest $request, $id)
    {
        CreditStep::where('id', $id)->update($request->except('_token', '_method'));

        return redirect()->route('steps.index')
            ->with(['message' => 'Шаг сохранён', 'class' => 'success']);
    }

    public function destroyAll(Request $request)
    {
        if ( $request->steps && count($request->steps)){
            CreditStep::destroy($request->steps);
            return redirect()->route('steps.index')
                ->with(['message' => 'Шаги удалены', 'class' => 'success']);
        } else {
            return back()->with(['message' => 'Не выбрано ни одного шага', 'class' => 'warning']);
        }
    }
    public function destroy( $id ) {

        if (CreditStep::destroy($id)){
            return response()->json( [
                "class" => "success", "message" => 'Шаг удален'
            ] );
        }
    }
}
