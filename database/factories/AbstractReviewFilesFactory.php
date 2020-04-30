<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\AbstractReviewFiles;
use Faker\Generator as Faker;

$factory->define(AbstractReviewFiles::class, function (Faker $faker) {

    return [

        'file'=>$faker->file('/tmp', '/tmp/upload'),

        'description'=>$faker->text,

        'abstract_review_id' => \App\AbstractReview::all()->random()
    ];
});
