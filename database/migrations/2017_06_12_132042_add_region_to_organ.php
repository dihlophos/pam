<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRegionToOrgan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('organs', function (Blueprint $table) {
            $table->integer('region_id')->unsigned()->nullable();
        });

        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::table('organs', function($table) {
            $table->foreign('region_id')->references('id')->on('regions')
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
        Schema::table('organs', function (Blueprint $table) {
            $table->dropForeign('organs_region_id_foreign');
        });
        Schema::table('organs', function (Blueprint $table) {
            $table->dropColumn('region_id');
        });
    }
}
