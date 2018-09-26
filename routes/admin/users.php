<?php

Route::get('/users', 'UserController@index')->name('users');
Route::get('/users/create', 'UserController@create')->name('users.create');
Route::get('/users/edit/{id}', 'UserController@edit')->name('users.edit');
Route::put('/users/update', 'UserController@update')->name('users.update');
Route::post('/users/store', 'UserController@store')->name('users.store');
Route::delete('/users/delete/{id}', 'UserController@destroy')->name('users.delete');
