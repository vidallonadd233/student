<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;


    protected $fillable = [
        'student_number',
        'grade_level'.
        'age',
        'gender',
        'time',
        'date',
        'description',
    ];
}
