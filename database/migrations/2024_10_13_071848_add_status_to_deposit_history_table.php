<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToDepositHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('deposit_history', function (Blueprint $table) {
            $table->string('status')->default('completed'); // Add the status column
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('deposit_history', function (Blueprint $table) {
            $table->dropColumn('status'); // Remove the status column if rolling back
        });
    }
}
