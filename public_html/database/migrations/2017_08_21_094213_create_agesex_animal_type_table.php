<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgesexAnimalTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agesex_animal_type', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('agesex_id')->unsigned();
            $table->integer('animal_type_id')->unsigned();
            $table->timestamps();
        });
        
        Schema::disableForeignKeyConstraints();
        
        Schema::table('agesex_animal_type', function (Blueprint $table) {
            $table->foreign('agesex_id')->references('id')->on('agesexes')->onDelete('cascade');
            $table->foreign('animal_type_id')->references('id')->on('animal_types')->onDelete('cascade');
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
        Schema::dropIfExists('agesex_animal_type');
    }
}
