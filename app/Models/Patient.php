<?php

namespace App\Models;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;
    use HasApiTokens;

    protected $guarded =[];
//    protected $fillable = [
//        'name',
//        'email',
//        'password',
//    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

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
