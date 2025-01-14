<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TreatmentPlan extends Model
{
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    protected $fillable = [
        'title',
        'description',
        'patient_id',
    ];
}
