<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\FullPaperReviewFiles;
use Faker\Generator as Faker;

$factory->define(FullPaperReviewFiles::class, function (Faker $faker) {

    return [

        'description'=>$faker->text,

        'file'=>$faker->file('/tmp', '/tmp/upload'),

        'full_paper_review_id' => \App\FullPaperReview::all()->random()
    ];
});
