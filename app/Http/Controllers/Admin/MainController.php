<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AchievementsRequest;
use App\Http\Requests\MainRequest;
use App\Models\Common\Achievement;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MainController extends Controller
{
    public function index($section)
    {
        switch ($section) {
            case 'bail':
                $title = 'под залог';
                break;
            case 'youget':
                $title = 'вы получаете';
                break;
            case 'ability':
                $title = 'специальные возможности';
                break;
        }
        $class = '\App\Models\Admin\Main\\'.ucwords($section);

        $pages = $class::all();

        return view('admin.main.index', compact('pages', 'section', 'title'));
    }

    public function edit($section, $id)
    {
        $class = '\App\Models\Admin\Main\\'.ucwords($section);
        $page = $class::findOrFail($id);

        return view('admin.main.edit', compact('page', 'section'));
    }

    public function update(MainRequest $request, $section, $id)
    {
        $input = $request->except('_token', '_method');

        $class = '\App\Models\Admin\Main\\'.ucwords($section);
        $page = $class::findOrFail($id);

        if ($request->has('image')) {

            $page->deleteImage($page->image, 'main');

            $image_main = $page->saveOriginalFile($request->image, 'main');

            $input['image'] = $image_main;
        } else {
            $input['image'] = $page->image;
        }

        if ($section == 'bail'){
            if ($request->has('image_bw')) {

                $page->deleteImage($page->image_bw, 'main');

                $image_new_bw = $page->saveOriginalFile($request->image_bw, 'main');
                $input['image_bw'] = $image_new_bw;
            } else {
                $input['image_bw'] = $page->image_bw;
            }
        }

        $page->update($input);

        return redirect()->route('main.index', ['section' => $section])
            ->with(['message' => 'Раздел отредактирован.', 'class' => 'success']);
    }

    public function editAchievements()
    {
        $achievement = Achievement::firstOrFail();
        return view('admin.main.edit_achievements', compact('achievement'));
    }

    public function updateAchievements(AchievementsRequest $request)
    {
        Achievement::firstOrFail()->update($request->only('years', 'cities', 'offices', 'clients', 'credits'));

        return redirect()->route('main.achievements.edit')
            ->with(['message' => 'Достижения отредактированы.', 'class' => 'success']);
    }
}
