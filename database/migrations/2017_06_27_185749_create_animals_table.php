<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnimalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('animals', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('object_id')->index()->unsigned();
            $table->integer('animal_type_id')->index()->unsigned();
            $table->smallInteger('age')->unsigned();
            $table->smallInteger('count')->unsigned();
            $table->string('regnum', 45)->nullable();
            $table->string('name', 45)->nullable();
            $table->date('birthday')->nullable();
            $table->string('marks', 255)->nullable();
            $table->string('chipnum', 45)->nullable();
            $table->timestamps();
        });

        Schema::table('animals', function($table) {
            $table->foreign('object_id')->references('id')->on('objects');
            $table->foreign('animal_type_id')->references('id')->on('animal_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('animals');
    }
}
