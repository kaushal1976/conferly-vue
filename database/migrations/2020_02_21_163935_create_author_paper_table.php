<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuthorPaperTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('author_paper', function (Blueprint $table) {

            $table->bigIncrements('id');

            $table->unsignedBigInteger('author_id');

            $table->foreign('author_id')
                ->on('authors')
                ->references('id')
                ->onDelete('cascade');

            $table->unsignedBigInteger('paper_id');

            $table->foreign('paper_id')
                ->on('papers')
                ->references('id')
                ->onDelete('cascade');

            $table->bigInteger('order')->default(0);

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
        Schema::dropIfExists('author_paper');
    }
}
