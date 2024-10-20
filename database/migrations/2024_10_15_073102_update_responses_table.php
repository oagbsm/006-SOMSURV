<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateResponsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('responses', function (Blueprint $table) {
            // Remove the answers field
            // $table->dropColumn('answers');

            // Add question_id and option_id fields
            // $table->foreignId('question_id')->constrained('questions')->onDelete('cascade')->after('user_id'); // Foreign key for questions
            $table->foreignId('option_id')->nullable()->constrained('options')->onDelete('cascade')->after('question_id'); // Foreign key for options (nullable)
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('responses', function (Blueprint $table) {
            // Restore the answers field
            $table->json('answers'); // Restore as JSON data

            // Remove the question_id and option_id fields
            $table->dropForeign(['question_id']); // Drop foreign key constraint for question_id
            $table->dropColumn('question_id'); // Drop question_id column
            $table->dropForeign(['option_id']); // Drop foreign key constraint for option_id
            $table->dropColumn('option_id'); // Drop option_id column
        });
    }
}
