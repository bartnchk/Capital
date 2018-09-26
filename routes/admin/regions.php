<?php

Route::get('/regions', 'RegionController@index')->name('regions');
Route::get('/regions/create', 'RegionController@create')->name('regions.create');
Route::get('/regions/edit/{id}', 'RegionController@edit')->name('regions.edit');
Route::put('/regions/update', 'RegionController@update')->name('regions.update');
Route::post('/regions/store', 'RegionController@store')->name('regions.store');
Route::delete('/regions/delete-all', 'RegionController@destroyAll')->name('regions.deleteAll');
Route::delete('/regions/delete/{id}', 'RegionController@destroy')->name('regions.delete');