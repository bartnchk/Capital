<?php

namespace App\Http\Controllers\Admin;

use App\Models\Common\Faq;
use App\Models\Common\FaqCategory;
use App\Http\Requests\CommonRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FaqController extends Controller
{
    public function index(Request $request)
    {
        $paginate = 15;
        $faqs = Faq::with('category')->paginate($paginate);
        $page = $request->has('page') ? $request->page*$paginate-$paginate : 0;


        return view('admin.faqs.index', compact('faqs', 'page'));
    }

    public function create()
    {
        $categories = FaqCategory::published()->get();

        return view('admin.faqs.create', compact('categories'));
    }

    public function edit($id)
    {
        $faq = Faq::findOrFail($id);
        $categories = FaqCategory::published()->get();

        return view('admin.faqs.create', compact('faq', 'categories'));
    }

    public function store(CommonRequest $request)
    {
        Faq::create($request->except('_token'));

        return redirect()->route('faqs.index')
            ->with(['message' => 'Вопрос сохранен', 'class' => 'success']);
    }

    public function update(CommonRequest $request, $id)
    {
        Faq::where('id', $id)->update($request->except('_token', '_method', 'url'));

        return redirect($request->url)
            ->with(['message' => 'Вопрос сохранён', 'class' => 'success']);
    }

    public function destroyAll(Request $request)
    {
        if ( $request->faqs && count($request->faqs)){
            Faq::destroy($request->faqs);
            return redirect()->route('faqs.index')
                ->with(['message' => 'Вопросы удалены', 'class' => 'success']);
        } else {
            return back()->with(['message' => 'Не выбрано ни одного вопроса', 'class' => 'warning']);
        }
    }
    public function destroy( $id ) {

        if (Faq::destroy($id)){
            return response()->json( [
                "class" => "success", "message" => 'Вопрос удален'
            ] );
        }
    }
}
