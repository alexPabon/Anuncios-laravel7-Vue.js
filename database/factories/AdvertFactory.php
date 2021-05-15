<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\models\Advert;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;

$factory->define(Advert::class, function (Faker $faker) {
    $products = ['moto', 'choche', 'bicicleta'];
    return [
        'city'=>$faker->city(),
        'product'=>Arr::random($products),
        'description'=>$faker->text($maxNbChars = 850).$faker->emoji(),
        'quantity'=>$faker->numberBetween(1,25),
        'price'=>$faker->randomFloat($nbMaxDecimals = 2, $min = 2, $max = 5000),
        'user_id' =>2
    ];
});
