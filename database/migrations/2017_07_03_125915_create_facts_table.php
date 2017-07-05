<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('basic_document_id')->index()->unsigned();
            $table->integer('animal_id')->index()->unsigned();
            $table->integer('service_id')->index()->unsigned();
            $table->date('date')->nullable();
            $table->timestamps();
        });

        Schema::table('facts', function($table) {
            $table->foreign('basic_document_id')->references('id')->on('basic_documents');
            $table->foreign('animal_id')->references('id')->on('animals');
            $table->foreign('service_id')->references('id')->on('services');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('facts');
    }
}
