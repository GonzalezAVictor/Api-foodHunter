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
	Route::delete('/users/followedRestaurants', 'FollowedRestaurantsController@unfollowRestaurant')->middleware('JWTmid');
	Route::post('/restaurants/random', 'RestaurantsController@getRandomRestaurant');
	Route::post('/restaurants/all', 'RestaurantsController@getAllRestaurantsWithCategories');

	// Promotions

		// Users
	Route::get('/restaurants/{id}/promotions', 'PromotionsController@find');
	Route::post('/users/followedPromotions', 'FollowedPromotionsController@followPromotion')->middleware('JWTmid');
	Route::delete('/users/followedPromotions', 'FollowedPromotionsController@unfollowPromotion')->middleware('JWTmid');
	Route::put('users/followedPromotions', 'FollowedPromotionsController@huntPromotion')->middleware('JWTmid');

		// Restaurants
	Route::delete('/restaurants/promotions/{promoId}', 'PromotionsController@destroy')->middleware('JWTrestaurant');
	Route::put('/restaurants/promotions/promotionsActive', 'PromotionsController@activePromotion')->middleware('JWTrestaurant');
	Route::put('/restaurants/promotions/{promoId}', 'PromotionsController@update')->middleware('JWTrestaurant');
	Route::post('/restaurants/promotions', 'PromotionsController@store')->middleware('JWTrestaurant');

	// Users
	Route::post('/users', 'UsersController@store');
	// Route::get('/users/{id}/restaurants', 'FollowedRestaurantsController@restaurantsFollowedByUser')->middleware('JWTmid');
	Route::put('/users', 'UsersController@update')->middleware('JWTmid');
	Route::get('/users/profile', 'UsersController@show')->middleware('JWTmid');


	// Categories
	Route::get('/categories', 'CategoriesController@index'); //Admin
	Route::post('/categories', 'CategoriesController@store'); //Admin
	Route::delete('/categories/{id}', 'CategoriesController@destroy'); //Admin

	// Sessions
	Route::post('/sessions', 'SessionsController@login');
	Route::post('/sessionsRestaurants', 'SessionsController@loginRestaurants');

	// Admin
	Route::post('/categoriesRestaurants', 'RestaurantsController@setCategoriesToRestaurant');

	Route::get('test', function () {
	  return 'Welcome to Food Hunter ';
	});

});


