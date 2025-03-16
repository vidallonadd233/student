<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStudentNumberToStudentsTable extends Migration
{
    public function up()
    {
        Schema::table('students', function (Blueprint $table) {
            // Add the student_number column if it does not exist
            if (!Schema::hasColumn('students', 'student_number')) {
                $table->string('student_number')->unique();
            }
        });
    }

    public function down()
    {
        Schema::table('students', function (Blueprint $table) {
            // Remove the column if rolling back
            $table->dropColumn('student_number');
        });
    }
}
