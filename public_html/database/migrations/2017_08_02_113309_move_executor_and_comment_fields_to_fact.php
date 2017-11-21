<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MoveExecutorAndCommentFieldsToFact extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::disableForeignKeyConstraints();
        Schema::table('diagnostic_tests', function (Blueprint $table) {
            $table->dropForeign(['executor_id']);
            $table->dropColumn('executor_id');
            $table->dropColumn('comment');
        });
        Schema::table('preventions', function (Blueprint $table) {
            $table->dropForeign(['executor_id']);
            $table->dropColumn('executor_id');
            $table->dropColumn('comment');
        });

        Schema::table('facts', function (Blueprint $table) {
            $table->integer('executor_id')->unsigned();
            $table->string('comment', 255)->nullable();
        });
        
        Schema::table('facts', function (Blueprint $table) {
            $table->foreign('executor_id')->references('id')->on('executors');
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
            $table->dropForeign(['executor_id']);
            $table->dropColumn('executor_id');
            $table->dropColumn('comment');
        });

        Schema::table('diagnostic_tests', function (Blueprint $table) {
            $table->integer('executor_id')->index()->unsigned();
            $table->string('comment', 255)->nullable();
        });
        
        Schema::table('diagnostic_tests', function (Blueprint $table) {
            $table->foreign('executor_id')->references('id')->on('executors');
        });
        
        Schema::table('preventions', function (Blueprint $table) {
            $table->integer('executor_id')->index()->unsigned();
            $table->string('comment', 255)->nullable();
        });
        
        Schema::table('preventions', function (Blueprint $table) {
            $table->foreign('executor_id')->references('id')->on('executors');
        });
        Schema::enableForeignKeyConstraints();        
    }
}
