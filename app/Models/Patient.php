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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function medicalHistories()
{
    return $this->hasMany(MedicalHistory::class);
}
public function visits()
{
    return $this->hasMany(Visit::class);
}


    protected $fillable = [
        'name',
        'dob',
        'user_id',
        'gender',
        'address',
        'phone',
        'email',
    ];
}

