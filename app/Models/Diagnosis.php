<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Diagnosis extends Model
{
    public function visit()
    {
        return $this->belongsTo(Visit::class);
    }

   protected $fillable = [
        'visit_id',
        'diagnosis_name',
        'description',
        'notes',
        
    ];
}

