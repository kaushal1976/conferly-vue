<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ThemeLeader;
use Faker\Generator as Faker;

$factory->define(ThemeLeader::class, function (Faker $faker) {

    return [

        'theme_id' => \App\Theme::all()->random(),

        'user_id' => \App\User::all()->random(),

    ];
});
