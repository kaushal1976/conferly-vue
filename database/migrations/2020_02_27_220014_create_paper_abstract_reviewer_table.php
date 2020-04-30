<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaperAbstractReviewerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paper_abstract_reviewer', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('reviewer_id');
            $table->foreign('reviewer_id')
                ->on('reviewers')
                ->references('id')
                ->onDelete('cascade');

            $table->unsignedBigInteger('paper_abstract_id');
            $table->foreign('paper_abstract_id')
                ->on('paper_abstracts')
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
        Schema::dropIfExists('paper_abstract_reviewer');
    }
}
