<?php

Route::get('/vacancies', 'VacancyController@index')->name('vacancies.index');
Route::get('/vacancy/create', 'VacancyController@create')->name('vacancies.create');
Route::get('/vacancy/edit/{id}', 'VacancyController@edit')->name('vacancies.edit');
Route::put('/vacancy/update/{id}', 'VacancyController@update')->name('vacancies.update');
Route::post('/vacancy/store', 'VacancyController@store')->name('vacancies.store');

Route::delete('/vacancies/delete/{id}', 'VacancyController@destroy')->name('vacancies.delete');

Route::post('/vacancies/delete-all', 'VacancyController@destroyAll')->name('vacancies.destroyAll');

Route::get('vacancies/get-categories', 'VacancyController@getCategories');
Route::get('vacancies/get-regions', 'VacancyController@getRegions');
Route::post('vacancies/get-cities', 'VacancyController@getCities');