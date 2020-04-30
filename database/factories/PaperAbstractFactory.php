<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\PaperAbstract;
use Faker\Generator as Faker;

$factory->define(PaperAbstract::class, function (Faker $faker) {

    return [

        'body'=>$faker->paragraph,

        'status'=>$faker->numberBetween($min = -1, $max = 4),

        'outcome'=>$faker->numberBetween($min = 0, $max = 4),

        'paper_id'=>App\Paper::all()->random()
    ];
});
