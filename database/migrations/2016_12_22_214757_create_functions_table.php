<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFunctionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('functions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->json('access_right');
        });
        Schema::table('rights', function (Blueprint $table) {
            $table->foreign('function_id')->references('id')->on('functions');
        });
        Schema::table('group_rights', function (Blueprint $table) {
            $table->foreign('function_id')->references('id')->on('functions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('group_rights', function (Blueprint $table) {
            $table->dropForeign('group_rights_function_id_foreign');
        });
        Schema::table('rights', function (Blueprint $table) {
            $table->dropForeign('rights_function_id_foreign');
        });
        Schema::dropIfExists('functions');
    }
}
