<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFullPaperFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('full_paper_files', function (Blueprint $table) {

            $table->bigIncrements('id');

            $table->string('description');

            $table->string('file');

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
        Schema::dropIfExists('full_paper_files');
    }
}
