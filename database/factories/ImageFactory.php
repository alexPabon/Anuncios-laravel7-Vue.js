<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\models\Image;
use Faker\Generator as Faker;

$factory->define(Image::class, function (Faker $faker) {
    return [
        'address'=>$faker->imageUrl($width = 400, $height = 200),
        'advert_id'=>$faker->numberBetween($min=1,$max=300),
    ];
});