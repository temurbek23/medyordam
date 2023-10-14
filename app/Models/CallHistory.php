<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CallHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        
	'id',
	'doctor_id',
	'patient_id',
	'duration',
	'created_at',
	'updated_at',
    ];
}
