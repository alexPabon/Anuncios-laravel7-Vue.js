<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\models\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    $categories = [
        'motor','formacion y libros','servicios',
        'imagen y sonido','telefonia','juegos',
        'telefonia','bebes','deporte',
        'moda y complementos','mascotas'
    ];

    return [
        'name'=>Array_random($categories),
    ];
});
