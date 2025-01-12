<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicalHistory extends Model
{
   protected    $fillable = [
        'patient_id',
        'type',
        'name',
        'date',
        'doctor_name',
        'hospital_name',
        'notes',
        'medications',
        'status',
        'severity',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
