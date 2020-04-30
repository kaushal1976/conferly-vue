<?php

use Illuminate\Database\Seeder;

class ExpertAreaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\ExpertArea::class, 20)->create()->each(function ($expert_area) {

            $expert_area->reviewers()->sync(App\Reviewer::all()->random(3));
        });
    }
}
