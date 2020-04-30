<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Author::class, 20)->create();

        factory(\App\Reviewer::class, 20)->create();

        $this->call(PapersTableSeeder::class);

        $this->call(PaperAbstractsTableSeeder::class);

        factory(\App\AbstractReview::class, 20)->create();

        factory(\App\AbstractReviewFiles::class, 20)->create();

        $this->call(ExpertAreaTableSeeder::class);

        factory(App\PaperFullPaper::class, 20)->create()->each(function ($paper_full_paper) {

            $paper_full_paper->reviewers()->sync(App\Reviewer::all()->random(3));

        });

        factory(\App\FullPaperFile::class, 20)->create();

        factory(\App\FullPaperReview::class, 20)->create();

        factory(\App\FullPaperReviewFiles::class, 20)->create();

        factory(\App\PaperCameraReadyPaper::class, 20)->create();

        factory(\App\Presenter::class, 20)->create();

        factory(\App\PaperPresentation::class, 20)->create();

        factory(\App\Registration::class, 20)->create();

        factory(\App\ThemeLeader::class, 20)->create();


    }
}
