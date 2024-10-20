<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveTargetFieldsFromQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('questions', function (Blueprint $table) {
            // Remove the target fields
            $table->dropColumn(['target_age_min', 'target_age_max', 'target_gender', 'target_location']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('questions', function (Blueprint $table) {
            // Restore the target fields
            $table->integer('target_age_min')->nullable();
            $table->integer('target_age_max')->nullable();
            $table->enum('target_gender', ['male', 'female', 'other', 'all'])->nullable();
            $table->string('target_location')->nullable();
        });
    }
}
