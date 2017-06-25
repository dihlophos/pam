<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePreparationSubdivisionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preparation_subdivision', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('preparation_id')->index()->unsigned();
            $table->integer('subdivision_id')->index()->unsigned();
        	$table->date('date');
            $table->date('doc_date')->nullable();
            $table->string('doc_num', 45);
            $table->integer('basic_document_id')->index()->unsigned();
        	$table->string('series', 45);
            $table->unsignedInteger('container_doses');
            $table->unsignedInteger('count_containers');
        	$table->unsignedInteger('used_containers');
        	$table->date('expire_date')->nullable();
            $table->enum('purchase_type', ['федеральный бюджет', 'СГЗ', 'СИЦ', 'ПД'])->default('федеральный бюджет');
        	$table->float('unit_price', 8, 2)->default(0);
        	$table->string('comment');
            $table->timestamps();
        });

        Schema::table('preparation_subdivision', function($table) {
            $table->foreign('preparation_id')->references('id')->on('preparations')->onDelete('cascade');
            $table->foreign('subdivision_id')->references('id')->on('subdivisions')->onDelete('cascade');
            $table->foreign('basic_document_id')->references('id')->on('basic_documents');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('preparation_subdivision');
    }
}
