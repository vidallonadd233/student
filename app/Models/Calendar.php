<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Calendar extends Model
{
    use HasFactory, SoftDeletes; // Use the correct SoftDeletes trait

    protected $table = 'calendar';

    // Define the fillable fields for mass assignment
    protected $fillable = [
        'student_number',
        'grade_level',
        'age',
        'gender',
        'time',
        'date',
        'description',
        'archived', // Add 'archived' to the fillable fields if used
    ];

    // If you're using soft deletes
    protected $dates = ['deleted_at'];

    // Optional: If you're using timestamps (created_at, updated_at)
    public $timestamps = true;
}
