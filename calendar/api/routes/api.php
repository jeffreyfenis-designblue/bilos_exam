<?php

use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::get('events', 'EventController@index');
    Route::get('events/{id}', 'EventController@show');
    Route::post('events', 'EventController@store');
    Route::put('events/{id}', 'EventController@update');
    Route::delete('events/{id}', 'EventController@destroy');
});