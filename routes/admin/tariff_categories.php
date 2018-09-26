<?php


Route::get('/tariff-categories', 'TariffCategoryController@index')->name('tariff_categories.index');
Route::get('/tariff-categories/create', 'TariffCategoryController@create')->name('tariff_categories.create');
Route::post('/tariff-categories', 'TariffCategoryController@store')->name('tariff_categories.store');
Route::get('/tariff-categories/{id}/edit', 'TariffCategoryController@edit')->name('tariff_categories.edit');
Route::put('/tariff-categories/{id}', 'TariffCategoryController@update')->name('tariff_categories.update');

Route::delete('/tariff-categories/{id}', 'TariffCategoryController@destroy')->name('tariff_categories.destroy');

Route::post('/tariff-categories/delete-all', 'TariffCategoryController@destroyAll')->name('tariff_categories.destroyAll');