<?php

namespace App\Models;
use App\Enums\InvoiceStatus;


use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    protected $fillable = [
        'patient_id',
        'amount',
        'status',
        'payment_date',
    ];

    protected $casts = [
        'status' => InvoiceStatus::class,
    ];
}

