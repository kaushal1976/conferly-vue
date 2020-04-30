<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\FullPaperReview;
use Faker\Generator as Faker;

$factory->define(FullPaperReview::class, function (Faker $faker) {

    return [

        'comments'=>$faker->paragraph,

        'recommendation'=>$faker->numberBetween(-1,4),

        'score'=>$faker->numberBetween(0,10),

        'paper_full_paper_id'=>\App\PaperFullPaper::all()->random(),
    ];
});
