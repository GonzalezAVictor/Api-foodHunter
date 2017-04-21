<?php




Route::group(['prefix' => 'api/v1'], function () {

	// Restaurants
	Route::get('/restaurants','RestaurantsController@index');
	Route::get('/restaurants/{id}', 'RestaurantsController@show');
	Route::post('/restaurants', 'RestaurantsController@store'); //Admin
	Route::delete('/restaurants/{id}', 'RestaurantsController@destroy'); //Admin
	Route::put('/restaurants/{id}', 'RestaurantsController@update'); //Admin

	// Promotions
	Route::get('/restaurants/{id}/promotions', 'PromotionsController@find');
	Route::post('/restaurants/{id}/promotions', 'PromotionsController@store');
	Route::delete('restaurants/{restaurant_id}/promotions/{promo_id}', 'PromotionsController@destroy');

	// Users
	Route::post('/users', 'UsersController@store');


	// Categories
	Route::get('/categories', 'CategoriesController@index'); //Admin
	Route::post('/categories', 'CategoriesController@store'); //Admin

	// Sessions

});


