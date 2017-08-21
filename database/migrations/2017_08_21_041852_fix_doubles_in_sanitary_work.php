<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FixDoublesInSanitaryWork extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sanitary_works', function($table) {
            $table->decimal('temperature', 5, 2)->default(0)->change();
            $table->decimal('concentration', 5, 2)->default(0)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sanitary_works', function($table) {
            $table->float('temperature', 3, 2)->default(0)->change();
            $table->float('concentration', 3, 2)->default(0)->change();
        });
    }
}
