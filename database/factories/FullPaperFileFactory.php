<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\FullPaperFile;
use Faker\Generator as Faker;

$factory->define(FullPaperFile::class, function (Faker $faker) {

    return [

        'description'=>$faker->text,

        'file'=>$faker->file('/tmp', '/tmp/upload'),

        'paper_full_paper_id'=>\App\PaperFullPaper::all()->random()

    ];
});
