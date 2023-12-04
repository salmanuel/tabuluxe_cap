<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scores', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('contestant_id')->unsigned();
            $table->bigInteger('judge_id')->unsigned();
            $table->bigInteger('criteria_id')->unsigned();
            $table->integer('score')->unsigned()->nullable();
            $table->timestamps();
            $table->foreign('contestant_id')->references('id')->on('contestants')->onDelete('cascade');
            $table->foreign('judge_id')->references('id')->on('judges')->onDelete('cascade');
            $table->foreign('criteria_id')->references('id')->on('criterias')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('scores');
    }
};
