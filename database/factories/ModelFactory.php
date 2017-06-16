<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('1234'),
        'remember_token' => str_random(10),
    ];
});


$factory->define(App\Category::class, function (Faker\Generator $faker)
{
	return [
		'name'=>$faker->name
	];
});

$factory->define(App\Restaurant::class, function (Faker\Generator $faker)
{
	return [
		'name'=>$faker->name,
		'openAt' => $faker->time($format = 'H:i:s', $max = 'now'),
		'closeAt' => $faker->time($format = 'H:i:s', $max = 'now'),
		'ubication' => $faker->address,
		'slogan' => $faker->sentence($nbWords = 6, $variableNbWords = true),
		'description' => $faker->sentence($nbWords = 6, $variableNbWords = true),
		'password' => $faker->password,
		'email' => $faker->email
	];
});

$factory->define(App\Promotion::class, function (Faker\Generator $faker)
{
	return [
		'name'=>$faker->name,
		'startAt' => $faker->time($format = 'H:i:s', $max = 'now'),
		'endAt' => $faker->time($format = 'H:i:s', $max = 'now'),
		'promotion_type' => 'flash',
		'details' => $faker->sentence($nbWords = 6, $variableNbWords = true),
    'restaurant_id' => $faker->numberBetween($min = 1, $max = 40),
		'category_id' => $faker->numberBetween($min = 1, $max = 12)

	];
});

// $factory->define(App\Promotion::class, function (Faker\Generator $faker)
// {
//   return [
//     'name'=>$faker->name,
//     'startAt' => $faker->time($format = 'H:i:s', $max = 'now'),
//     'endAt' => $faker->time($format = 'H:i:s', $max = 'now'),
//     'promotion_type' => 'premium',
//     'details' => $faker->sentence($nbWords = 6, $variableNbWords = true),
//     'amount_available' =>$faker->numberBetween($min = 1, $max = 10),
//     'restaurant_id' => $faker->numberBetween($min = 1, $max = 40),
//     'category_id' => $faker->numberBetween($min = 1, $max = 12)

//   ];
// });
