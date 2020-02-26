<?php

    Route::get('persons','PersonsController@index')->name('persons');
    Route::post('persons/create','PersonsController@store')->name('create_persons');
    Route::get('persons/edit/{id}','PersonsController@edit')->name('edit_persons');
    Route::put('persons/{id}','PersonsController@update')->name('update_persons');
    Route::delete('persons/{id}','PersonsController@delete')->name('delete_persons');

    //MULTAS
    Route::get('penalty','PenaltyController@index')->name('penalty');
    Route::post('penalty/create','PenaltyController@store')->name('create_penalty');
    Route::get('penalty/edit/{id}','PenaltyController@edit')->name('edit_penalty');
    Route::put('penalty/{id}','PenaltyController@update')->name('update_penalty');
    Route::delete('penalty/{id}','PenaltyController@delete')->name('delete_penalty');
    Route::get('penalty/disabled','PenaltyController@penaltyDisabled')->name('penalty_disabled');
    Route::get('getPersons/{id}','PenaltyController@getPersons')->name('get_persons');
