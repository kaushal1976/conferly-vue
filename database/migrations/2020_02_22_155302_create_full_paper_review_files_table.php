<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFullPaperReviewFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('full_paper_review_files', function (Blueprint $table) {

            $table->bigIncrements('id');

            $table->text('description');

            $table->string('file');

            $table->unsignedBigInteger('full_paper_review_id');

            $table->foreign('full_paper_review_id')
                ->on('full_paper_reviews')
                ->references('id')
                ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('full_paper_review_files');
    }
}
