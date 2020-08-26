<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\models\Consultasip;
use Faker\Generator as Faker;

$factory->define(Consultasip::class, function (Faker $faker) {
    return [
        // 'number_ip'=>$faker->ipv4(),
        'number_ip'        =>"100.31.228.217",
        'address'=>'/alladverts'
    ];
});
