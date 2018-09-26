<?php

Route::get('/pages', 'PageController@index')->name('pages.index');
//Route::get('/pages/create', 'PageController@create')->name('pages.create');
//Route::post('/pages', 'PageController@store')->name('pages.store');
Route::get('/pages/{id}/edit', 'PageController@edit')->name('pages.edit');
Route::put('/pages/{id}', 'PageController@update')->name('pages.update');
