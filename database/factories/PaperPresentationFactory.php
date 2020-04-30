<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\PaperPresentation;
use Faker\Generator as Faker;

$factory->define(PaperPresentation::class, function (Faker $faker) {

    return [

        'file'=>$faker->file('/tmp', '/tmp/upload'),

        'paper_id'=>\App\Paper::all()->random(),

        'presenter_id'=>\App\Presenter::all()->random()

    ];
});
