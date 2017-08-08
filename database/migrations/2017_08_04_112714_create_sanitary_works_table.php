<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSanitaryWorksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sanitary_works', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('object_id')->unsigned();
            $table->integer('fact_id')->unsigned();
            $table->integer('preparation_receipt_id')->unsigned();
            $table->integer('application_method_id')->unsigned();
            $table->integer('objects_count')->unsigned();
            $table->integer('count')->unsigned();
            $table->integer('count_gz')->unsigned();
            $table->integer('indoor_count')->unsigned();
            $table->integer('indoor_count_gz')->unsigned();
            $table->integer('outdoor_count')->unsigned();
            $table->integer('outdoor_count_gz')->unsigned();
            $table->integer('preparation_used_doses')->unsigned()->default(0);
            $table->float('preparation_used_containers', 8, 2)->default(0);
            $table->integer('preparation_destroyed_doses')->unsigned()->default(0);
            $table->float('temperature', 3, 2)->default(0);
            $table->float('concentration', 3, 2)->default(0);
            $table->float('сonsumption', 8, 2)->default(0);
            $table->timestamps();
        });
        
        Schema::table('sanitary_works', function($table) {
            $table->foreign('object_id')->references('id')->on('objects')->onDelete('cascade');
            $table->foreign('fact_id')->references('id')->on('facts')->onDelete('cascade');
            $table->foreign('preparation_receipt_id')->references('id')->on('preparation_receipts');
            $table->foreign('application_method_id')->references('id')->on('application_methods');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sanitary_works');
    }
}
