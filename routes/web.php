<?php

// ->middleware('JWTmid')
Route::group(['prefix' => 'api/v1'], function () {

	// Restaurants
	Route::get('/restaurants','RestaurantsController@index');
	Route::get('/restaurants/{id}', 'RestaurantsController@show');
	Route::post('/restaurants', 'RestaurantsController@store'); //Admin
	Route::delete('/restaurants/{id}', 'RestaurantsController@destroy'); //Admin
	Route::put('/restaurants/{id}', 'RestaurantsController@update'); //Admin
	Route::post('/users/followedRestaurants', 'FollowedRestaurantsController@followRestaurant')->middleware('JWTmid');
	Route::delete('/users/{userId}/followedRestaurants/{restaurantId}', 'FollowedRestaurantsController@unfollowRestaurant')->middleware('JWTmid');

	// Promotions

		// Users
	Route::get('/restaurants/{id}/promotions', 'PromotionsController@find');
	Route::post('/users/followedPromotions', 'FollowedPromotionsController@followPromotion')->middleware('JWTmid');
	Route::delete('/users/{userId}/followedPromotions/{promoId}', 'FollowedPromotionsController@unfollowPromotion');

		// Restaurants
	Route::delete('restaurants/{restaurantId}/promotions/{promoId}', 'PromotionsController@destroy');
	Route::post('/promotions/promotionsActive', 'PromotionsController@activePromotion');
	Route::put('/restaurants/{restaurantId}/promotions/{promoId}', 'PromotionsController@update');
	Route::post('/restaurants/{restaurantId}/promotions', 'PromotionsController@store');

	// Users
	Route::post('/users', 'UsersController@store');
	Route::get('/users/{id}/restaurants', 'FollowedRestaurantsController@restaurantsFollowedByUser')->middleware('JWTmid');
	Route::put('/users', 'UsersController@update')->middleware('JWTmid');


	// Categories
	Route::get('/categories', 'CategoriesController@index'); //Admin
	Route::post('/categories', 'CategoriesController@store'); //Admin
	Route::delete('/categories/{id}', 'CategoriesController@destroy'); //Admin

	// Sessions
	Route::post('/sessions', 'SessionsController@login');

});


