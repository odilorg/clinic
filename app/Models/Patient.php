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

    // public function labTests()
    // {
    //     return $this->hasMany(LabTest::class);
    // }

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

public function prescriptions()
{
    return $this->hasManyThrough(
        \App\Models\Prescription::class,
        \App\Models\Visit::class,
        'patient_id',        // Foreign key on the visits table
        'visit_id',          // Foreign key on the prescriptions table
        'id',                // Local key on the patients table
        'id'                 // Local key on the visits table
    );
}

public function labTests()
{
    return $this->hasManyThrough(
        LabTest::class, // Final model
        Visit::class,   // Intermediate model
        'patient_id',   // Foreign key on visits table
        'visit_id',     // Foreign key on lab_tests table
        'id',           // Local key on patients table
        'id'            // Local key on visits table
    );
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

