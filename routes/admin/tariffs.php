<?php

Route::get('/tariffs', 'TariffController@index')->name('tariffs.index');
Route::get('/tariffs/create', 'TariffController@create')->name('tariffs.create');
Route::post('/tariffs', 'TariffController@store')->name('tariffs.store');
Route::get('/tariffs/{id}/edit', 'TariffController@edit')->name('tariffs.edit');
Route::put('/tariffs/{id}', 'TariffController@update')->name('tariffs.update');

Route::delete('/tariffs/{tariff}', 'TariffController@destroy')->name('tariffs.destroy');

Route::post('/tariffs/delete-all', 'TariffController@destroyAll')->name('tariffs.destroyAll');