<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\models\Visit;
use Faker\Generator as Faker;

$factory->define(Visit::class, function (Faker $faker) {
    return [
        'number_ip'=>$faker->ipv4(),        
        'address'=>'/alladverts',
        'user_name'=>'carlos',
        'email'=>'carlos@gmail.com'
    ];
});
