<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
	use HasFactory;

	protected $fillable = [
		'firstname',
		'lastname',
		'password',
		'email',
		'contact',
		'main_profession',
		'photo',
		'about',
		'education',
		'practice',
		'practice_in_years',
		'residency',
		'created_at',
		'updated_at',
	];

	public function professions()
	{
		return $this->belongsToMany(Profession::class);
	}
}
