<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaperFullPapersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paper_full_papers', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->integer('status');
            $table->integer('outcome');
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
        Schema::dropIfExists('paper_full_papers');
    }
}
