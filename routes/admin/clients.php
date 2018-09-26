<?php

    Route::get('clients', 'ClientController@index')->name('clients.index');

    Route::get('clients/create', 'ClientController@create')->name('client.create');

    Route::post('clients/delete-all', 'ClientController@destroyAll')->name('clients.destroyAll');

    Route::get('clients/create', 'ClientController@create')->name('clients.create');

    Route::get('clients/edit/{id}', 'ClientController@edit')->name('clients.edit');

    Route::delete('client/delete/{client}', 'ClientController@destroy')->name('client.delete');

    Route::post('client/store', 'ClientController@store')->name('client.store');

    Route::put('clients/update/{id}', 'ClientController@update')->name('client.update');