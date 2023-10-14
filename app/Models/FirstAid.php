<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FirstAid extends Model
{
    use HasFactory;

    protected $fillable = [
        
	'id',
	'case',
	'photo',
	'treatment',
	'created_at',
	'updated_at',
    ];
}
