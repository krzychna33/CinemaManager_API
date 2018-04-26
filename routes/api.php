<?php

use Illuminate\Http\Request;

Route::group([
    'middleware' => 'auth.api'
], function(){
    Route::resources([
        'movies' => 'MoviesController',
        'showings' => 'ShowingsController',
    ]);

    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
});

Route::get('showings', 'ShowingsController@index');
Route::get('showings/{showing}', 'ShowingsController@show');


Route::resources([
    'reservations' => 'ReservationsController'
]);

Route::get('reservations/cancel-reservation/{hash}', 'ReservationsController@cancelReservation');

Route::post('login', 'AuthController@login');
