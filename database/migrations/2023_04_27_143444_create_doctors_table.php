<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
           $table->foreignId('user_id');
            $table->string('name');
            $table->string('email')->unique();
            // $table->string('password');
            $table->string('phone_No')->unique()->nullable();
//            $table->time('work_hours');
            $table->text('qualifications')->nullable();
            $table->string('address')->nullable();
            $table->string('image')->nullable();
            $table->enum('rateing',[0,1,2,3,4,5])->default(0);
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
        Schema::dropIfExists('doctors');
    }
}
