<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Doctor extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded =[];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function patientBiographies(){
        return $this->hasMany(PatientBiography::class);
    }

    public function workHours(){
        return $this->hasMany(WorkHour::class);

    }

    public function appointments(){
        return $this->hasMany(Appointment::class);
    }

    public function patients()
    {
        return $this->belongsToMany(Patient::class, 'doctor_patient', 'doctor_id', 'patient_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
