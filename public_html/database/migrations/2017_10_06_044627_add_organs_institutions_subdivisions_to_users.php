<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOrgansInstitutionsSubdivisionsToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('organ_id')->unsigned()->nullable();
            $table->integer('institution_id')->unsigned()->nullable();
            $table->integer('subdivision_id')->unsigned()->nullable();
            $table->dropColumn('role_id');
            $table->boolean('is_admin')->default(false);
        });
        
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::table('users', function($table) {
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
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::table('users', function (Blueprint $table) {
            $table->integer('role_id')->index();
            $table->dropColumn('is_admin');
            $table->dropForeign('users_organ_id_foreign');
            $table->dropForeign('users_institution_id_foreign');
            $table->dropForeign('users_subdivision_id_foreign');
        });
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
        
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('organ_id');
            $table->dropColumn('institution_id');
            $table->dropColumn('subdivision_id');
        });
    }
}
