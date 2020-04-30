<?php

use Illuminate\Database\Seeder;
class PaperAbstractsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\PaperAbstract::class, 20)->create()->each(function ($paper_abstract) {
            $paper_abstract->reviewers()->sync(App\Reviewer::all()->random(3));
        });
        factory(\App\Keyword::class, 20)->create();
    }
}
