<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAgesexToAnimals extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::table('animals', function (Blueprint $table) {
            $table->integer('agesex_id')->unsigned();
        });
        
        Schema::table('animals', function (Blueprint $table) {
            $table->foreign('agesex_id')->references('id')->on('agesexes');
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
        Schema::table('animals', function (Blueprint $table) {
            $table->dropForeign(['agesex_id']);
            $table->dropColumn('agesex_id');
        });
        Schema::enableForeignKeyConstraints();
    }
}
