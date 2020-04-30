<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\PaperCameraReadyPaper;
use Faker\Generator as Faker;

$factory->define(PaperCameraReadyPaper::class, function (Faker $faker) {

    return [

        'file'=>$faker->file('/tmp', '/tmp/upload'),

        'approved'=>$faker->boolean,

        'paper_id'=>\App\Paper::all()->random()
    ];
});
