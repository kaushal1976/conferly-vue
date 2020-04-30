<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaperFullPaperReviewerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paper_full_paper_reviewer', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('reviewer_id');
            $table->foreign('reviewer_id')
                ->on('reviewers')
                ->references('id')
                ->onDelete('cascade');

            $table->unsignedBigInteger('paper_full_paper_id');
            $table->foreign('paper_full_paper_id')
                ->on('paper_full_papers')
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
        Schema::dropIfExists('paper_full_paper_reviewer');
    }
}
