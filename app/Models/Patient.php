<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function treatments()
    {
        return $this->hasMany(TreatmentPlan::class);
    }

    public function diagnoses()
    {
        return $this->hasMany(Diagnosis::class);
    }

    public function labTests()
    {
        return $this->hasMany(LabTest::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    protected $fillable = [
        'first_name',
        'last_name',
        'dob',
        'user_id',
        'gender',
        'address',
        'phone',
        'email',
    ];
}

