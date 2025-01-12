<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LabTestResult extends Model
{
    protected $fillable = ['lab_test_id', 'parameter_name', 'result', 'unit', 'image_path'];

    public function labTest()
    {
        return $this->belongsTo(LabTest::class, 'lab_test_id', 'id'); // Explicit FK and referenced key
    }
    

}
