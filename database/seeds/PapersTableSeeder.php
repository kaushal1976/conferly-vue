<?php

use Illuminate\Database\Seeder;

class PapersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        factory(App\Paper::class, 20)->create()->each(function ($paper) {

            $paper->authors()->sync(App\Author::all()->random(3));

        });

    }
}
