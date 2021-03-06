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
            $table->integer('region_id')->unsigned()->nullable();
            $table->integer('district_id')->unsigned()->nullable();
            $table->integer('municipality_id')->unsigned()->nullable();
            $table->integer('city_id')->unsigned()->nullable();
            $table->integer('organ_id')->unsigned()->nullable();
            $table->integer('institution_id')->unsigned()->nullable();
            $table->integer('subdivision_id')->unsigned()->nullable();
            $table->string('address', 250)->nullable();
            $table->string('phone', 50)->nullable();
            $table->float('land_area', 8, 2)->nullable();
            $table->float('processing_area', 8, 2)->nullable();

        });

        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::table('objects', function($table) {
            $table->foreign('region_id')->references('id')->on('regions')
                ->onUpdate('cascade')->onDelete('set null');
            $table->foreign('district_id')->references('id')->on('districts')
                ->onUpdate('cascade')->onDelete('set null');
            $table->foreign('municipality_id')->references('id')->on('municipalities')
                ->onUpdate('cascade')->onDelete('set null');
            $table->foreign('city_id')->references('id')->on('cities')
                ->onUpdate('cascade')->onDelete('set null');
            $table->foreign('organ_id')->references('id')->on('organs')
                ->onUpdate('cascade')->onDelete('set null');
            $table->foreign('institution_id')->references('id')->on('institutions')
                ->onUpdate('cascade')->onDelete('set null');
            $table->foreign('subdivision_id')->references('id')->on('subdivisions')
                ->onUpdate('cascade')->onDelete('set null');
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
            $table->dropForeign('objects_region_id_foreign');
            $table->dropForeign('objects_district_id_foreign');
            $table->dropForeign('objects_municipality_id_foreign');
            $table->dropForeign('objects_organ_id_foreign');
            $table->dropForeign('objects_institution_id_foreign');
            $table->dropForeign('objects_subdivision_id_foreign');
        });
        Schema::table('objects', function (Blueprint $table) {
            $table->dropColumn('region_id');
            $table->dropColumn('district_id');
            $table->dropColumn('municipality_id');
            $table->dropColumn('city_id');
            $table->dropColumn('organ_id');
            $table->dropColumn('institution_id');
            $table->dropColumn('subdivision_id');
            $table->dropColumn('address');
            $table->dropColumn('phone');
            $table->dropColumn('land_area');
            $table->dropColumn('processing_area');
        });
    }
}
