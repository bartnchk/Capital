<?php

    Route::get('feedbacks', 'FeedbackController@index')->name('feedbacks');

    Route::get('feedbacks/create', 'FeedbackController@create')->name('feedbacks.create');

    Route::get('feedbacks/edit/{id}', 'FeedbackController@edit')->name('feedbacks.edit');

    Route::put('feedbacks/update/{id}', 'FeedbackController@update')->name('feedbacks.update');

    Route::post('feedbacks/store', 'FeedbackController@store')->name('feedbacks.store');

    Route::delete('feedbacks/delete/{id}', 'FeedbackController@destroy')->name('feedbacks.delete');

    Route::post('feedbacks/delete-all', 'FeedbackController@destroyAll')->name('feedbacks.destroyAll');