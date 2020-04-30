<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Presenter;
use Faker\Generator as Faker;

$factory->define(Presenter::class, function (Faker $faker) {

    return [

        'biography'=>$faker->paragraph,

        'user_id' => \App\User::all()->random()
    ];

});
