<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DerbouHumanEfficiency extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('derbou_human_efficiency', function (Blueprint $table) {
            $table->increments('id');
            $table->date('data_date');
            $table->string('time_region')->nullable();
            $table->string('machine_no')->nullable();
            $table->string('yard')->nullable();
            $table->string('kind')->nullable();
            $table->string('memo')->nullable();
            $table->integer('user_id')->unsigned();
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
        Schema::dropIfExists('derbou_human_efficiency');
    }
}
