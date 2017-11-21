<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiagnosticTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diagnostic_tests', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('object_id')->unsigned();
            $table->integer('fact_id')->unsigned();
            $table->integer('research_type_id')->unsigned();
            $table->integer('executor_id')->unsigned();
            $table->integer('preparation_receipt_id')->unsigned();
            $table->enum('year_multiplicity', ['первый раз', 'второй раз'])->default('первый раз');
            $table->enum('service_characteristics', ['первично', 'вторично'])->default('первично');
            $table->integer('count')->unsigned();
            $table->integer('count_gz')->unsigned();
            $table->integer('count_positive')->unsigned();
            $table->string('comment', 255)->nullable();
            $table->string('conclusion_num', 255)->nullable();
            $table->integer('preparation_used_doses')->unsigned()->default(0);
            $table->float('preparation_used_containers', 8, 2)->default(0);
            $table->integer('preparation_destroyed_doses')->unsigned()->default(0);

            $table->timestamps();
        });

        Schema::table('diagnostic_tests', function($table) {
            $table->foreign('object_id')->references('id')->on('objects')->onDelete('cascade');
            $table->foreign('fact_id')->references('id')->on('facts')->onDelete('cascade');
            $table->foreign('executor_id')->references('id')->on('executors');
            $table->foreign('preparation_receipt_id')->references('id')->on('preparation_receipts');
            $table->foreign('research_type_id')->references('id')->on('research_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('diagnostic_tests');
    }
}
