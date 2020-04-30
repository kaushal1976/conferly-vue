<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaperAbstractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paper_abstracts', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->text('body');

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
        Schema::dropIfExists('paper_abstracts');
    }
}
