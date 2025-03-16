<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalendarArchive extends Model
{

    protected $table = 'calendar_archives';

    protected $fillable = [
        'source_table',
        'student_number',
        'grade_level',
        'age',
        'date',
        'time',
        'gender',
        'description'
    ];
    use HasFactory;
}
