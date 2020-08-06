<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\UserDetail;
use Faker\Generator as Faker;

$factory->define(UserDetail::class, function (Faker $faker) {
    return [
        'Field-Shooting' =>$faker->name,
        'licensed' => $faker->boolean,
        'user_id' =>$faker->random_int,
    ];
});
