<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CallHistory extends Model
{
	use HasFactory;

	protected $fillable = [
		'doctor_id',
		'patient_id',
		'duration',
		'created_at',
		'updated_at',
	];

	public function doctor()
	{
		return $this->belongsTo(Doctor::class);
	}

	public function patient()
	{
		return $this->belongsTo(Patient::class);
	}
}
