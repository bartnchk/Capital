<?php

Route::get('/banners', 'BannerController@index')->name('banners.index');
Route::get('/banners/create', 'BannerController@create')->name('banners.create');
Route::post('/banners', 'BannerController@store')->name('banners.store');
Route::get('/banners/{id}/edit', 'BannerController@edit')->name('banners.edit');
Route::put('/banners/{id}', 'BannerController@update')->name('banners.update');
Route::delete('/banner/delete/{banner}', 'BannerController@destroy')->name('banners.destroy');
Route::post('/banners/delete-all', 'BannerController@destroyAll')->name('banners.destroyAll');