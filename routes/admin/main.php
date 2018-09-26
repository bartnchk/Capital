<?php

// раздел наши достижения

Route::get('/main/achievements', 'MainController@editAchievements')->name('main.achievements.edit');
Route::put('/main/achievements/update', 'MainController@updateAchievements')->name('main.achievements.update');

// остальные разделы

Route::get('/main/{section}', 'MainController@index')->name('main.index');
Route::get('/main/{section}/{id}/edit', 'MainController@edit')->name('main.edit');
Route::put('/main/{section}/{id}', 'MainController@update')->name('main.update');