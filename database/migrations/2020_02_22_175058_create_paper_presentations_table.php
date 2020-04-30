<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaperPresentationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paper_presentations', function (Blueprint $table) {

            $table->bigIncrements('id');

            $table->string('file');

            $table->unsignedBigInteger('paper_id');

            $table->foreign('paper_id')
                ->on('papers')
                ->references('id')
                ->onDelete('cascade');

            $table->unsignedBigInteger('presenter_id');

            $table->foreign('presenter_id')
                ->on('presenters')
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
        Schema::dropIfExists('paper_presentations');
    }
}
