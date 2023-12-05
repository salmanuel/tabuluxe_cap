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
        Schema::create('rounds', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('contest_id')->unsigned();
// <<<<<<< Updated upstream:database/migrations/2023_11_15_121600_create_rounds_table.php
            $table->bigInteger('next_round_id')->nullable()->unsigned();
            $table->string('name')->nullable();
// =======
            $table->integer('rounds')->nullable();
            $table->integer('no_of_contestants')->nullable();
// >>>>>>> Stashed changes:database/migrations/2023_11_15_122140_create_rounds_table.php
            $table->timestamps();

            $table->foreign('contest_id')->references('id')->on('contests')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('next_round_id')->references('id')->on('rounds')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rounds');
    }
};
