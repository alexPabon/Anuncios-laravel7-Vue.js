<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'phone'=> $faker->e164PhoneNumber(),
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'privilege_id'=>'1',
        'password' => '$2y$08$WpNIMSarAtPsVvbBnPuGSesbQ9gMxqv4s0iQKweHyJLxmtWQqmk1q', // password
        'remember_token' => Str::random(10),
    ];
});
