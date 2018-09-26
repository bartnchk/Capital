<?php


Route::get('/reports', 'ReportController@index')->name('reports.index');
Route::get('/reports/create', 'ReportController@create')->name('reports.create');
Route::post('/reports', 'ReportController@store')->name('reports.store');
Route::get('/reports/{id}/edit', 'ReportController@edit')->name('reports.edit');
Route::put('/reports/{id}', 'ReportController@update')->name('reports.update');

Route::delete('/reports/{report}', 'ReportController@destroy')->name('reports.destroy');

Route::post('/reports/delete-all', 'ReportController@destroyAll')->name('reports.destroyAll');

Route::delete('/documents/{document}', 'DocumentController@destroy')->name('documents.destroy');