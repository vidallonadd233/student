<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // Correct SoftDeletes import


class ReportIncident extends Model
{
    use HasFactory , SoftDeletes;

    // Define the table name
    protected $table = 'report_incident';

    // Define the primary key (optional if it's `id`)
    protected $primaryKey = 'id';

    public $timestamps = false;

    // Define which fields can be mass-assigned
    protected $fillable = [
        'student_number',
        'age',
        'report_date',
        'category',
        'location',
        'evidence',
        'person_involved',
        'status',
        'remark',
        'description',
        'archived',
        'can_report',


    ];

    // Optionally, you can define date format if needed
    protected $dates = ['report_date','delete_at']; // Add 'deleted_at' for soft deletes
    public function reports()
    {
        return $this->hasMany(ReportIncident::class, 'student_id');
    }

}
