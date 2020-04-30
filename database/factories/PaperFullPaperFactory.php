<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\PaperFullPaper;
use Faker\Generator as Faker;

$factory->define(PaperFullPaper::class, function (Faker $faker) {

    return [

        'status'=>$faker->numberBetween(0,4),

        'outcome'=>$faker->numberBetween(-1,4),

        'paper_id'=>\App\Paper::all()->random()

    ];
});
