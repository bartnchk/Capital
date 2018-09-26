<?php

Route::get('/news', 'NewsController@index')->name('news.index');
Route::get('/news/create', 'NewsController@create')->name('news.create');
Route::post('/news', 'NewsController@store')->name('news.store');
// Search
//Route::get('/news/search', 'NewsController@search')->name('news.search');

//Route::delete('/news/images/{id}', 'NewsController@destroyImage');

Route::get('/news/{id}/edit', 'NewsController@edit')->name('news.edit');
Route::put('/news/{id}', 'NewsController@update')->name('news.update');

Route::delete('/news/{news}', 'NewsController@destroy')->name('news.destroy');

Route::post('/news/delete-all', 'NewsController@destroyAll')->name('news.destroyAll');
