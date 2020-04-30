<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Reviewer;
use Faker\Generator as Faker;

$factory->define(Reviewer::class, function (Faker $faker) {

    return [

        'available'=>$faker->boolean,

        'max_reviews'=>$faker->numberBetween(0,6),

        'user_id'=>\App\User::all()->random()
    ];
});
