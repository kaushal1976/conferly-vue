<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Registration;
use Faker\Generator as Faker;

$factory->define(Registration::class, function (Faker $faker) {

    return [

        'invoice'=>$faker->file('/tmp', '/tmp/upload'),

        'basis'=>$faker->numberBetween(0,5),

        'presenter_id'=>\App\Presenter::all()->random()
    ];
});
