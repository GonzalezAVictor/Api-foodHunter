<?php




Route::group(['prefix' => 'api/v1'], function () {

	// Restaurants
	Route::get('/restaurants','RestaurantsController@index');
	Route::get('/restaurants/{id}', 'RestaurantsController@show');
	Route::post('/restaurants', 'RestaurantsController@store');
	Route::delete('/restaurants/{id}', 'RestaurantsController@destroy');
	Route::put('/restaurants/{id}', 'RestaurantsController@update');

	// Promotions
	Route::get('/restaurants/{id}/promotions', 'PromotionsController@find');

	// Users


	// Sessions

});


