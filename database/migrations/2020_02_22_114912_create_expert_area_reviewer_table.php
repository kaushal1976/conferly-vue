<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpertAreaReviewerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expert_area_reviewer', function (Blueprint $table) {

            $table->bigIncrements('id');

            $table->unsignedBigInteger('expert_area_id');

            $table->foreign('expert_area_id')
                ->on('expert_areas')
                ->references('id')
                ->onDelete('cascade');

            $table->unsignedBigInteger('reviewer_id');

            $table->foreign('reviewer_id')
                ->on('reviewers')
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
        Schema::dropIfExists('expert_area_reviewer');
    }
}
