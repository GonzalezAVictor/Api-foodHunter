<?php

// ->middleware('JWTmid')
Route::group(['prefix' => 'api/v1'], function () {

	// Restaurants
	Route::get('/restaurants','RestaurantsController@index');
	Route::get('/restaurants/{id}', 'RestaurantsController@show');
	Route::post('/restaurants', 'RestaurantsController@store'); //Admin
	Route::delete('/restaurants/{id}', 'RestaurantsController@destroy'); //Admin
	Route::put('/restaurants/{id}', 'RestaurantsController@update'); //Admin -
	Route::post('/users/followedRestaurants', 'FollowedRestaurantsController@followRestaurant');
	Route::delete('/users/{userId}/followedRestaurants/{restaurantId}', 'FollowedRestaurantsController@unfollowRestaurant');

	// Promotions

		// Users
	Route::get('/restaurants/{id}/promotions', 'PromotionsController@find');
	Route::delete('restaurants/{restaurantId}/promotions/{promoId}', 'PromotionsController@destroy');
	Route::post('/users/followedPromotions', 'FollowedPromotionsController@followPromotion')->middleware('JWTmid');
	Route::delete('/users/{userId}/followedPromotions/{promotionId}', 'FollowedPromotionsController@unfollowPromotion');

		// Restaurants
	Route::put('/promotions/promotionsActive', 'PromotionsController@activePromotion');
	Route::post('/restaurants/{id}/promotions', 'PromotionsController@store');

	// Users
	Route::post('/users', 'UsersController@store');
	Route::get('/users/restaurants', 'UsersController@restaurantsFollowedByUser');
	Route::get('/users/{userId}/promotions', 'FollowedPromotionsController@promotionsFollowedByUse');


	// Categories
	Route::get('/categories', 'CategoriesController@index'); //Admin
	Route::post('/categories', 'CategoriesController@store'); //Admin

	// Sessions
	Route::post('/sessions', 'SessionsController@login');

});
