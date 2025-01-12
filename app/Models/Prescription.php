<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    public function visit()
{
    return $this->belongsTo(Visit::class);
}
protected $fillable = [
    'medication_name',
    'dosage',
    'instructions',
    'visit_id',
    'frequency',
    'duration',
];
}
