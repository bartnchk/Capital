<?php


Route::get('/faq-categories', 'FaqCategoryController@index')->name('faq_categories.index');
Route::get('/faq-categories/create', 'FaqCategoryController@create')->name('faq_categories.create');
Route::post('/faq-categories', 'FaqCategoryController@store')->name('faq_categories.store');
Route::get('/faq-categories/{id}/edit', 'FaqCategoryController@edit')->name('faq_categories.edit');
Route::put('/faq-categories/{id}', 'FaqCategoryController@update')->name('faq_categories.update');

Route::delete('/faq-categories/{id}', 'FaqCategoryController@destroy')->name('faq_categories.destroy');

Route::post('/faq-categories/delete-all', 'FaqCategoryController@destroyAll')->name('faq_categories.destroyAll');