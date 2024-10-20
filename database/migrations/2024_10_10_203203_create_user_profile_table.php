<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_profile', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID
            $table->foreignId('userid')->constrained('users')->onDelete('cascade'); // Assuming you have a 'users' table
            $table->integer('age')->nullable();
            $table->string('gender')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->string('region')->nullable();
            $table->string('education_level')->nullable();
            $table->string('telecom1')->nullable();
            $table->string('telecom2')->nullable();
            $table->string('mobile_money1')->nullable();
            $table->string('mobile_money2')->nullable();
            $table->string('nationality1')->nullable();
            $table->string('bank1')->nullable();
            $table->string('bank2')->nullable();
            $table->enum('employment_status', ['employed', 'unemployed'])->nullable();
            $table->enum('salary_range', ['A', 'B', 'C'])->nullable();
            $table->timestamps(); // Created at and updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_profile');
    }
}
