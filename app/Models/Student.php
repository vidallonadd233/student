<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes; // Import SoftDeletes trait

class Student extends Authenticatable
{
    use HasFactory, SoftDeletes; // Include SoftDeletes trait for soft deletes

    protected $table = 'students'; // Ensure the correct table name

    protected $fillable = [
        'student_number',
        'grade_level',
        'age',
        'gender',
        'password',
        'status',
        'role',
        'picture',
    ];

    protected $hidden = [
        'password',
    ];

    // Define which column should be used for authentication
    public function getAuthIdentifierName()
    {
        return 'student_number';
    }

    // Define how the password will be retrieved for authentication
    public function getAuthPassword()
    {
        return $this->password;
    }

    // Define the relationship with the Logins model (if applicable)
    public function logins()
    {
        return $this->hasMany(Login::class); // Ensure this points to the correct Login model
    }

    // Archive the student by moving them to the student archives table
    public function archive()
    {
        // Logic for archiving the student
        // You may need to copy data to a separate archive table here.
    }

    // Restore an archived student (from soft deletes or archive table)
    public function restoreArchivedStudent($id)
    {
        $archivedStudent = self::onlyTrashed()->findOrFail($id);
        $archivedStudent->restore();
    }
}
