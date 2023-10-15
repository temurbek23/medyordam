<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disease extends Model
{
	use HasFactory;

	protected $fillable = [
		'name',
		'treatment',
		'created_at',
		'updated_at',
	];

	public function symptoms()
	{
		return $this->belongsToMany(Symptom::class);
	}
}
