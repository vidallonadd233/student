<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportArchive extends Model
{
    protected $table  = 'report_archived';

    protected $fillable = [
        'student_number',
        'age',
        'report_date',
        'category',
        'location',
        'evidence',
     'person_involved',
        'status',
        'description'
    ];
    use HasFactory;


    protected $dates = ['report_date'];
}
