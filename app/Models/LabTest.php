<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LabTest extends Model
{
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    protected $fillable = [
       'visit_id',  
       'lab_test_type_id',
         'notes',
    ];

    public function labTestType()
    {
        return $this->belongsTo(LabTestType::class, 'lab_test_type_id', 'id'); // Explicit FK and referenced key
    }
    
    public function visit()
    {
        return $this->belongsTo(Visit::class, 'visit_id', 'id'); // Explicit FK and referenced key
    }

    public function results()
    {
        return $this->hasMany(LabTestResult::class);
    }
}

