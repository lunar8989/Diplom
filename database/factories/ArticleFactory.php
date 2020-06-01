<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Article;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Article::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence,
        'description' => $faker->text($maxNbChars = 200),
        'price' => $faker->numberBetween($min = 0, $max = 100000),
        'category' => Str::random(10),
        'img' => '../images/dogtest.jpg',
        'date' => $faker->date(),
		'views' => $faker->numberBetween($min = 0, $max = 100),
		'likes' => $faker->numberBetween($min = 0, $max = 100),
    ];
});
