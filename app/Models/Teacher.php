<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Teacher extends Authenticatable
{
    use HasFactory;


public $timestamps  = false;

    protected $table = 'teachers';
    protected $fillable = [
     'email', 'password' ,'role','profile_picture'
    ];

    protected $guarded = [];
    protected $hidden = ['password', 'remember_token'];
}
