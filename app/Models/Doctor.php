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

    protected $fillable = [
        'name',
        'phone',
        'email',
        'address',
        'specialization',
        'license_number',
        'user_id',
    ];
}

