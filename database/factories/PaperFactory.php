<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Paper;
use Faker\Generator as Faker;

$factory->define(Paper::class, function (Faker $faker) {

    return [

        'title'=>$faker->sentence,

        'reference'=>$faker->unique()->word,

        'theme_id' => factory(App\Theme::class)
    ];
});
