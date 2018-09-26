<?php

Route::get('/settings/create', 'SettingController@create')->name('settings.create');
Route::get('/settings', 'SettingController@edit')->name('settings');
Route::put('/settings/update', 'SettingController@update')->name('settings.update');
Route::post('/settings/store', 'SettingController@store')->name('settings.store');
