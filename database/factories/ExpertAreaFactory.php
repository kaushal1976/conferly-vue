<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ExpertArea;
use Faker\Generator as Faker;

$factory->define(ExpertArea::class, function (Faker $faker) {

    return [

        'description'=>$faker->sentence,

    ];
});
