<?php

    Route::get('actions', 'ActionController@index')->name('admin.actions.index');

    Route::get('actions/create', 'ActionController@create')->name('action.create');

    Route::post('actions/delete-all', 'ActionController@destroyAll')->name('actions.destroyAll');

    Route::get('actions/create', 'ActionController@create')->name('actions.create');

    Route::get('actions/edit/{id}', 'ActionController@edit')->name('actions.edit');

    Route::delete('action/delete/{action}', 'ActionController@destroy')->name('action.delete');

    Route::post('action/store', 'ActionController@store')->name('action.store');

    Route::put('actions/update/{id}', 'ActionController@update')->name('action.update');