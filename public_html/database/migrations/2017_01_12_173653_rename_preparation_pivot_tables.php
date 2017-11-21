<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenamePreparationPivotTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //models in pivot table mast be in aplphabetical order for laravel magic to work by default
        Schema::rename('preparation_disease', 'disease_preparation');
        Schema::rename('preparation_application_method', 'application_method_preparation');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::rename('disease_preparation', 'preparation_disease');
        Schema::rename('application_method_preparation', 'preparation_application_method');
    }
}
