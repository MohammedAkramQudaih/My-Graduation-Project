<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users', 'id');
            $table->string('name');
            $table->string('email')->unique();
            // $table->string('password');
            $table->string('phone_No')->unique()->nullable();
            $table->float('age')->nullable();
            $table->string('image')->nullable();
            $table->string('address')->nullable();
            $table->date('birthdate')->nullable();
            $table->enum('gender', ['male', 'female']);
            $table->enum('diabetic_type', ['Type 1 Diabetes', 'Type 2 Diabetes', 'Gestational diabetes', 'unknown'])->default('unknown')->nullable();
            $table->text('patient_status')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('patients');
    }
}
