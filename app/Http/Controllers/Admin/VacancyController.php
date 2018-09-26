<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\VacancyRequest;
use App\Models\Admin\Region;
use App\Models\Common\Vacancy;
use App\Models\Common\VacancyCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VacancyController extends Controller
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

        $vacancies = Vacancy::paginate($elemsOnPage);

        return view('admin.vacancies.index', ['vacancies' => $vacancies, 'counter' => $counter]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $regions = Region::all();
        return view('admin.vacancies.edit', ['regions' => $regions]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(VacancyRequest $request)
    {
        $vacancy = new Vacancy();
        $vacancy->fill($request->all());
        if ($vacancy->save()) {
            return redirect('admin/vacancies')->with(['message' => 'Вакансия сохранена', 'class' => 'success']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $regions = Region::all();
        $vacancy = Vacancy::findOrFail($id);

        return view('admin.vacancies.edit', ['vacancy' => $vacancy, 'regions' => $regions]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(VacancyRequest $request, $id)
    {
        $vacancy = Vacancy::findOrFail($id);
        $vacancy->update($request->all());

        return redirect('admin/vacancies')->with(['message' => 'Вакансия сохранена', 'class' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (is_array($id)) {
            $vacancy = Vacancy::whereIn('id', $id);
        } else {
            $vacancy = Vacancy::find($id);
        }
        if ($vacancy->delete()) {
            return response()->json(['message' => 'Вакансия удалена', 'class' => 'success'], 200);
        }
    }


    public function destroyAll(Request $request)
    {
        if ($request->vacancies && count($request->vacancies)) {
            $this->destroy($request->vacancies);

            return back()->with(['message' => 'Вакансии удалены', 'class' => 'success']);
        }
    }

    public function getCategories()
    {
        $categories = VacancyCategory::where('published', true)->get();

        return response()->json($categories, 200);
    }

    public function getRegions()
    {
        $categories = Region::where('published', true)->get();

        return response()->json($categories, 200);
    }

    public function getCities(Request $request)
    {
        if ($request->get('id')) {
            $cities = Region::whereHas('cities', function ($query) use ($request) {
                $query->where('region_id', $request->get('id'));
                $query->where('published', true);
            })->where('published', true)->first()->cities;

            return response()->json($cities, 200);
        }
    }
}
