<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaperCameraReadyPapersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paper_camera_ready_papers', function (Blueprint $table) {

            $table->bigIncrements('id');

            $table->string('file');

            $table->boolean('approved');

            $table->unsignedBigInteger('paper_id');

            $table->foreign('paper_id')
                ->on('papers')
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
        Schema::dropIfExists('paper_camera_ready_papers');
    }
}
