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
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone_No')->unique();
            $table->float('age')->nullable();
            $table->string('image')->nullable();
            $table->string('address');
            $table->date('birthdate');
            $table->enum('sex',['female','male']);
            $table->enum('diabetic_type',['Type 1 Diabetes','Type 2 Diabetes','Gestational diabetes','unknown'])->default('unknown');
//            $table->string('attachments')->nullable();
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
