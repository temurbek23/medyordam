<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        
	'id',
	'firstname',
	'lastname',
	'password',
	'email',
	'contact',
	'created_at',
	'updated_at',
    ];
}
