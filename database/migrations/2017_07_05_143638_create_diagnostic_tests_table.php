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
            $table->integer('object_id')->index()->unsigned();
            $table->integer('fact_id')->index()->unsigned();
            $table->integer('research_type_id')->index()->unsigned();
            $table->integer('executor_id')->index()->unsigned();
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
