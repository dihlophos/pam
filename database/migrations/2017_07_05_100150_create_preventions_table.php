<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePreventionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preventions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('object_id')->index()->unsigned();
            $table->integer('fact_id')->index()->unsigned();
            $table->integer('executor_id')->index()->unsigned();
            $table->integer('preparation_receipt_id')->index()->unsigned();
            $table->integer('application_method_id')->index()->unsigned();
            $table->enum('service_type', ['профилактическая', 'вынужденная'])->default('профилактическая');
            $table->integer('count')->unsigned();
            $table->integer('count_gz')->unsigned();
            $table->integer('count_final')->unsigned();
            $table->integer('count_ill')->unsigned();
            $table->integer('count_rip')->unsigned();
            $table->string('comment', 255)->nullable();
            $table->integer('preparation_used_doses')->unsigned()->default(0);
            $table->float('preparation_used_containers', 8, 2)->default(0);
            $table->integer('preparation_destroyed_doses')->unsigned()->default(0);
            $table->timestamps();
        });

        Schema::table('preventions', function($table) {
            $table->foreign('object_id')->references('id')->on('objects')->onDelete('cascade');;
            $table->foreign('fact_id')->references('id')->on('facts')->onDelete('cascade');;
            $table->foreign('executor_id')->references('id')->on('executors');
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
        Schema::dropIfExists('preventions');
    }
}
