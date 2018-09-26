<?php

Route::get('/cities', 'CityController@index')->name('cities');
Route::get('/cities/create', 'CityController@create')->name('cities.create');
Route::get('/cities/edit/{id}', 'CityController@edit')->name('cities.edit');
Route::put('/cities/update', 'CityController@update')->name('cities.update');
Route::post('/cities/store', 'CityController@store')->name('cities.store');
Route::delete('/cities/delete/{id}', 'CityController@destroy')->name('cities.delete');
Route::post('/cities/delete-all', 'CityController@destroyAll')->name('cities.deleteAll');
Route::post('/cities/get-cities', 'CityController@getCities');
