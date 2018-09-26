<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SettingsRequest;
use App\Models\Admin\Settings;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $settings = new Settings();
        $settings->fill($request->all());
        if ($settings->save()) {
            return back()->with('success', 'Настройки сохранены!');
        }
    }

    public function edit()
    {
        $settings = Settings::all()->first();

        return view('admin.settings.index', ['settings' => $settings]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SettingsRequest $request)
    {
        Settings::find($request->get('id'))->update($request->all());
        return back()->with('success', 'Настройки сохранены!');
    }

}
