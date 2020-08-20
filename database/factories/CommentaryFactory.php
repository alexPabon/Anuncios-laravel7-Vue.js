<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\models\Commentary;
use Faker\Generator as Faker;

$factory->define(Commentary::class, function (Faker $faker) {
    return [
        'description'=>$faker->text($maxNbChars = 850).$faker->emoji(),
        'user_id' =>2
    ];
});
