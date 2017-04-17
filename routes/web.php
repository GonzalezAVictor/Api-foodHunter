<?php


Route::get('/', function () {
    return view('welcome');
});

// Restaurants 

Route::get('/restaurants','RestaurantsController@index');
Route::post('/restaurants', 'RestaurantsController@store');
Route::delete('/restaurant/{id}', 'RestaurantsController@destroy');
Route::put('/restaurant/{id}', 'RestaurantsController@update');


// Promotions

Route::get('/restaurant/{id}/promotions', 'PromotionsController@find');



