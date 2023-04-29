<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    public function patientBiography(){
        return $this->hasOne(PatientBiography::class);
    }
    public function measurements(){
        return $this->hasMany(Measurement::class);
    }

    public function appointments(){
        return $this->hasMany(Appointment::class);
    }


    public function attachments()
    {
        return $this->hasMany(Attachment::class);
    }
}
