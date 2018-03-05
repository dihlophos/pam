<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveFactsExecutorId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::table('facts', function (Blueprint $table) {
            $table->dropForeign(['executor_id']);
            $table->dropColumn('executor_id');
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
         Schema::table('facts', function (Blueprint $table) {
            $table->integer('executor_id')->unsigned();
        });
        Schema::table('facts', function (Blueprint $table) {
            $table->foreign('executor_id')->references('id')->on('executors');
        });
        Schema::enableForeignKeyConstraints();
    }
}
