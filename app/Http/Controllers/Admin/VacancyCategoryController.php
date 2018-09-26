<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CommonRequest;
use App\Models\Common\VacancyCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VacancyCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $elemsOnPage = 10;
        $request->page = $request->page ? $request->page : 1;
        $counter = $request->page * $elemsOnPage - $elemsOnPage;

        $categories = VacancyCategory::paginate($elemsOnPage);
        return view('admin.vacancy_categories.index', ['categories' => $categories, 'counter' => $counter]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.vacancy_categories.edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommonRequest $request)
    {
        $category = new VacancyCategory();
        $category->fill($request->all());
        if ($category->save()){
            return redirect('admin/vacancy-categories')->with(['message' => 'Вакансия сохранена', 'class' => 'success']);
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = VacancyCategory::findOrFail($id);
        return view('admin.vacancy_categories.edit' , ['category' => $category]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CommonRequest $request, $id)
    {
        $category = VacancyCategory::findOrFail($id);
        $category->update($request->all());
        return redirect('admin/vacancy-categories')->with(['message' => 'Вакансия сохранена', 'class' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (is_array($id)) {
            $category = VacancyCategory::whereIn('id', $id);
        } else {
            $category = VacancyCategory::find($id);
        }
        if ($category->delete()) {
            return response()->json(['message' => 'Вакансия удалена', 'class' => 'success'], 200);
        }
    }


    public function destroyAll(Request $request)
    {
        if ($request->categories && count($request->categories)) {
            $this->destroy($request->categories);

            return back()->with(['message' => 'Вакансии удалены', 'class' => 'success']);
        }
    }
}
