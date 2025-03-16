<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Students extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'student';
    protected $casts = [
        'student_number' => 'integer',
    ];

    protected $fillable = [
        'student_number',
        'grade_level',
        'age',
        'gender',




    ];

    protected $dates = ['deleted_at'];
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    // Check if student exists
    public static function isStudentRegistered($studentNumber)
    {
        return self::where('student_number', $studentNumber)->exists();
    }



}
