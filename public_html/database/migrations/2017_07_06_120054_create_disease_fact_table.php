<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiseaseFactTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('disease_fact', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('disease_id')->index()->unsigned();
            $table->integer('fact_id')->index()->unsigned();
            $table->timestamps();
        });

        Schema::table('disease_fact', function($table) {
            $table->foreign('disease_id')->references('id')->on('diseases');
            $table->foreign('fact_id')->references('id')->on('facts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('disease_fact');
    }
}
