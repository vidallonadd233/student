<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{



    protected $fillable = [
        'student_number',
        'age',
        'grade',
        'gender',
        'status',
        'feedback',
    ];
    use HasFactory;
}
