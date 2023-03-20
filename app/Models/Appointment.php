<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Appointment extends Model
{
    use HasFactory;

    protected $table = 'appointments';

    protected $fillable = [
        'appointment_no',
        'appointment_date',
        'doctor_id',
        'patient_name',
        'patient_phone',
        'total_fee',
        'paid_amount'
    ];

    protected $casts = [
        'id' => 'integer',
    ];
}
