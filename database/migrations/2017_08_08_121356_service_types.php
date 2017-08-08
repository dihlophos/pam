<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ServiceTypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });
        
        Schema::create('service_service_type', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('service_id')->unsigned();
            $table->integer('service_type_id')->unsigned();
            $table->timestamps();
        });
        
        Schema::disableForeignKeyConstraints();
        
        Schema::table('service_service_type', function (Blueprint $table) {
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');
            $table->foreign('service_type_id')->references('id')->on('service_types')->onDelete('cascade');
        });
        
        Schema::table('facts', function (Blueprint $table) {
             $table->integer('service_type_id')->unsigned();
        });
        
        Schema::table('facts', function (Blueprint $table) {
            $table->foreign('service_type_id')->references('id')->on('service_types');
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
            $table->dropForeign(['service_type_id']);
            $table->dropColumn('service_type_id');
        });
        Schema::enableForeignKeyConstraints();

        Schema::dropIfExists('service_service_type');
        Schema::dropIfExists('service_types');
    }
}
