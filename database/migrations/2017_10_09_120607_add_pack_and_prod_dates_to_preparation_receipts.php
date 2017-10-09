<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPackAndProdDatesToPreparationReceipts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('preparation_receipts', function (Blueprint $table) {
            $table->date('pack_date')->nullable();
            $table->date('prod_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('preparation_receipts', function (Blueprint $table) {
            $table->dropColumn('pack_date');
            $table->dropColumn('prod_date');
        });
    }
}
