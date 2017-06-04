<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCityToObject extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('objects', function (Blueprint $table) {
            $table->integer('city_id')->unsigned()->default(0);
        });

        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::table('objects', function($table) {
            $table->foreign('city_id')->references('id')->on('cities');
        });
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('objects', function (Blueprint $table) {
            $table->dropForeign('objects_city_id_foreign');
        });

        Schema::table('objects', function (Blueprint $table) {
            $table->dropColumn('city_id');
        });
    }
}
