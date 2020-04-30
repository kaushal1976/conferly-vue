<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Keyword;
use Faker\Generator as Faker;

$factory->define(Keyword::class, function (Faker $faker) {

    return [

        'body'=>$faker->sentence(3),

        'paper_abstract_id'=>\App\PaperAbstract::all()->random()
    ];
});
