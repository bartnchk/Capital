<?php

Route::get('/offices', 'OfficeController@index')->name('offices');
Route::get('/offices/create', 'OfficeController@create')->name('offices.create');
Route::get('/offices/edit/{id}', 'OfficeController@edit')->name('offices.edit');
Route::put('/offices/update', 'OfficeController@update')->name('offices.update');
Route::post('/offices/store', 'OfficeController@store')->name('offices.store');

Route::delete('/offices/delete/{id}', 'OfficeController@destroy')->name('offices.delete');

Route::post('/offices/delete-all', 'OfficeController@destroyAll')->name('offices.destroyAll');

Route::post('/offices/get-cities', 'OfficeController@getCities');
