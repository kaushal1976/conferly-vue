<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Author;
use Faker\Generator as Faker;

$factory->define(Author::class, function (Faker $faker) {
    return [

        'affiliation'=>$faker->sentence,

        'user_id'=>factory(App\User::class)

    ];
});
