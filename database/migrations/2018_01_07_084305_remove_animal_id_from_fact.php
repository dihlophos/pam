<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveAnimalIdFromFact extends Migration
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
            $table->dropForeign(['animal_id']);
            $table->dropColumn('animal_id');
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
            $table->integer('animal_id')->unsigned();
        });

        Schema::table('facts', function (Blueprint $table) {
            $table->foreign('animal_id')->references('id')->on('animals');
        });
        Schema::enableForeignKeyConstraints();
    }
}
