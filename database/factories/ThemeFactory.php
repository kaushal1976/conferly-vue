<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Theme;
use Faker\Generator as Faker;

$factory->define(Theme::class, function (Faker $faker) {

    return [

        'title'=>$faker->sentence,

        'description'=>$faker->paragraph,

        'conference_id'=>factory(App\Conference::class)
    ];
});
