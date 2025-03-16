<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // Import the SoftDeletes trait

class StudentArchive extends Model
{
    use HasFactory, SoftDeletes; // Apply the SoftDeletes trait

    protected $table = 'studentarchive';

    protected $fillable = [
        'student_number',
        'grade_level',
        'age',
        'gender',
        'archived',  // Add 'archived' to the fillable attributes
    ];

    // Optional: You can define the name of the "deleted_at" column if needed
    protected $dates = ['deleted_at']; // This allows the model to recognize the soft delete column

}
