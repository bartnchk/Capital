<?php

Route::get('/vacancy-categories', 'VacancyCategoryController@index')->name('vacancies.category.index');
Route::get('/vacancies/category/create', 'VacancyCategoryController@create')->name('vacancies.category.create');
Route::get('/vacancies/category/edit/{id}', 'VacancyCategoryController@edit')->name('vacancies.category.edit');
Route::put('/vacancies/category/update/{id}', 'VacancyCategoryController@update')->name('vacancies.category.update');
Route::post('/vacancies/category/store', 'VacancyCategoryController@store')->name('vacancies.category.store');

Route::delete('/vacancies-category/delete/{id}', 'VacancyCategoryController@destroy')->name('vacancies.category.delete');

Route::post('/vacancies-category/delete-all', 'VacancyCategoryController@destroyAll')->name('vacancies.category.destroyAll');

