<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSurveytargetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surveytarget', function (Blueprint $table) {
            $table->id();
            $table->foreignId('survey_id')->constrained('surveys')->onDelete('cascade'); // links to surveys table
            $table->integer('age')->nullable();
            $table->enum('gender', ['male', 'female', 'other'])->nullable();
            $table->string('education_level')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->string('region')->nullable();
            $table->string('telecom1')->nullable();
            $table->string('telecom2')->nullable();
            $table->string('mobile_money1')->nullable();
            $table->string('mobile_money2')->nullable();
            $table->string('nationality1')->nullable();
            $table->string('bank1')->nullable();
            $table->string('bank2')->nullable();
            $table->enum('employment_status', ['employed', 'unemployed'])->nullable();
            $table->enum('salary_range', ['A', 'B', 'C'])->nullable(); // only if employed
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
        Schema::dropIfExists('surveytarget');
    }
}
