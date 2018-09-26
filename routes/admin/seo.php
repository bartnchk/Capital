<?php

Route::get('/seo', 'SeoController@index')->name('seo.index');

Route::get('/seo/{id}/edit', 'SeoController@edit')->name('seo.edit');
Route::put('/seo/{id}', 'SeoController@update')->name('seo.update');
