<?php


Route::get('/faqs', 'FaqController@index')->name('faqs.index');
Route::get('/faqs/create', 'FaqController@create')->name('faqs.create');
Route::post('/faqs', 'FaqController@store')->name('faqs.store');
Route::get('/faqs/{id}/edit', 'FaqController@edit')->name('faqs.edit');
Route::put('/faqs/{id}', 'FaqController@update')->name('faqs.update');

Route::delete('/faqs/{id}', 'FaqController@destroy')->name('faqs.destroy');

Route::post('/faqs/delete-all', 'FaqController@destroyAll')->name('faqs.destroyAll');