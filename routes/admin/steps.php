<?php


Route::get('/steps', 'CreditStepController@index')->name('steps.index');
Route::get('/steps/create', 'CreditStepController@create')->name('steps.create');
Route::post('/steps', 'CreditStepController@store')->name('steps.store');
Route::get('/steps/{id}/edit', 'CreditStepController@edit')->name('steps.edit');
Route::put('/steps/{id}', 'CreditStepController@update')->name('steps.update');

Route::delete('/steps/{id}', 'CreditStepController@destroy')->name('steps.destroy');

Route::post('/steps/delete-all', 'CreditStepController@destroyAll')->name('steps.destroyAll');