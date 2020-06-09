<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Countries;
use Faker\Generator as Faker;


$factory->define(Countries::class, function (Faker $faker) {
    return [
        'name' => $faker->country
    ];
});
