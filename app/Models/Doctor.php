<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = [
        
	'id',
	'firstname',
	'lastname',
	'password',
	'email',
	'contact',
	'photo',
	'about',
	'education',
	'practice',
	'residency',
	'created_at',
	'updated_at',
    ];
}
