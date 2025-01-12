<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LabTestType extends Model
{
    
    protected $fillable = ['name', 'parameters'];

    protected $casts = [
        'parameters' => 'array', // Parameters are stored as JSON
    ];

    public function labTests()
    {
        return $this->hasMany(LabTest::class);
    }
}
