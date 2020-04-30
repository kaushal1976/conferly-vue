<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbstractReviewFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('abstract_review_files', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('file');

            $table->string('description');

            $table->unsignedBigInteger('abstract_review_id');

            $table->foreign('abstract_review_id')
                ->on('abstract_reviews')
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
        Schema::dropIfExists('abstract_review_files');
    }
}
