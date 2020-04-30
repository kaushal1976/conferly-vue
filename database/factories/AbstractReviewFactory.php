<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\AbstractReview;
use Faker\Generator as Faker;

$factory->define(AbstractReview::class, function (Faker $faker) {

    return [

        'comments'=>$faker->paragraph,

        'recommendation'=>$faker->numberBetween(1,4),

        'score'=>$faker->numberBetween(0,10),

        'paper_abstract_id'=>\App\PaperAbstract::all()->random(),

        'reviewer_id'=>\App\Reviewer::all()->random()
    ];
});
