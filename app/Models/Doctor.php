<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    public function patientBiographies(){
        return $this->hasMany(PatientBiography::class);
    }

    public function workHours(){
        return $this->hasMany(WorkHour::class);

    }

    public function appointments(){
        return $this->hasMany(Appointment::class);
    }
}
