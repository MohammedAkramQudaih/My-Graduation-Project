<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientBiographiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_biographies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained('patients','id');
            $table->foreignId('doctor_id');
            $table->longText('diagnostics');   // التشخيص
            $table->text('medications');    /// الأدوية
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
        Schema::dropIfExists('patient_biographies');
    }
}
