<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Archives extends Model
{

    protected $fillable = [
        'student_number',
        'grade_level',
        'age',
        'gender',


    ];

    use HasFactory;
}
