<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function diagnoses()
    {
        return $this->hasMany(Diagnosis::class);
    }

    public function specialization()
    {
        return $this->belongsTo(Specialization::class);
    }

    protected $fillable = [
        'name',
        'phone',
        'email',
        'address',
        'specialization_id',
        'license_number',
        'user_id',
    ];
}

