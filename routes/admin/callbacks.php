<?php

Route::get('/callbacks', 'CallbackController@index')->name('callbacks.index');
//Route::get('/callbacks/create', 'CallbackController@create')->name('callbacks.create');
Route::post('/callbacks', 'CallbackController@store')->name('callbacks.store');
//Route::get('/callbacks/{id}/edit', 'CallbackController@edit')->name('callbacks.edit');
Route::put('/callbacks/{id}', 'CallbackController@update')->name('callbacks.update');

//Route::get('/banners/{id}', 'CallbackController@destroy')->name('banners.destroy');
Route::delete('/callbacks/{id}', 'CallbackController@destroy')->name('callbacks.destroy');

Route::post('/callbacks/delete-all', 'CallbackController@destroyAll')->name('callbacks.destroyAll');