<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Conference;
use Faker\Generator as Faker;
use Siro\RandImg\RandImgProvider;

$factory->define(Conference::class, function (Faker $faker) {
    $start = $faker->dateTimeBetween('now', '+45 days');
    $end = strtotime('+1 Week', $start->getTimestamp());
    return [
        'title'=>$faker->sentence,
        'tag_line'=>$faker->sentence,
        'description'=>$faker->paragraph,
        'start_date'=>$start,
        'end_date'=>$end,
        'venue'=>$faker->address,
        'subject_area'=>$faker->sentence,
        'image'=>$faker->image(storage_path().'/app/public/conference/images', 640,480, null, false)
    ];
});
