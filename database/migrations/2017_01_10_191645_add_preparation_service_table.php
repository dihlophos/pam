<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPreparationServiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preparation_service', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('preparation_id')->index();
            $table->integer('service_id')->index();
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
        Schema::table('preparation_service', function (Blueprint $table) {
            Schema::dropIfExists('preparation_service');
        });
    }
}
