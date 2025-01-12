<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    
    
    public function patient()
{
    return $this->belongsTo(Patient::class);
}

public function doctor()
{
    return $this->belongsTo(Doctor::class);
}

public function labTests()
{
    return $this->hasMany(LabTest::class);
}
protected $fillable = [
    'patient_id',
    'doctor_id',
    'visit_date',
    'reason',
    'diagnosis',
    'notes',
];
public function prescriptions()
{
    return $this->hasMany(Prescription::class);
}

public function diagnoses()
{
    return $this->hasMany(Diagnosis::class);
}

// public function procedures()
// {
//     return $this->hasMany(Procedure::class);
// }

}
