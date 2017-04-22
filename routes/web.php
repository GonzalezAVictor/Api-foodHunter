<?php




Route::group(['prefix' => 'api/v1'], function () {

	// Restaurants
	Route::get('/restaurants','RestaurantsController@index');
	Route::get('/restaurants/{id}', 'RestaurantsController@show');
	Route::post('/restaurants', 'RestaurantsController@store'); //Admin
	Route::delete('/restaurants/{id}', 'RestaurantsController@destroy'); //Admin
	Route::put('/restaurants/{id}', 'RestaurantsController@update'); //Admin
	Route::post('/restaurants/{restaurantId}/ambush', 'RestaurantsController@followRestaurant');

	// Promotions

		// Users
	Route::get('/restaurants/{id}/promotions', 'PromotionsController@find');
	Route::post('/restaurants/{id}/promotions', 'PromotionsController@store');
	Route::delete('restaurants/{restaurantId}/promotions/{promoId}', 'PromotionsController@destroy');
	Route::post('/promotions/{promoId}/abmush', 'PromotionsController@followPromotion');
	Route::post('/promotions/{promoId}/hunt', 'PromotionsController@huntPromotion');

		// Restaurants
	Route::post('/promotions/{promoId}/active', 'PromotionsController@activePromotion');


	// Users
	Route::post('/users', 'UsersController@store');


	// Categories
	Route::get('/categories', 'CategoriesController@index'); //Admin
	Route::post('/categories', 'CategoriesController@store'); //Admin

	// Sessions
	Route::post('/sessions', 'SessionsController@login');

});


