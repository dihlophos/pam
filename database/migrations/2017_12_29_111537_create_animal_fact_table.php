<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnimalFactTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('animal_fact', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('animal_id')->index()->unsigned();
            $table->integer('fact_id')->index()->unsigned();
            $table->timestamps();
        });
        
        Schema::table('animal_fact', function($table) {
            $table->foreign('animal_id')->references('id')->on('animals');
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
        Schema::dropIfExists('animal_fact');
    }
}
