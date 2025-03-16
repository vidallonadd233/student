<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateStudentNumberColumnInStudentsTable extends Migration
{
    public function up()
    {
        Schema::table('students', function (Blueprint $table) {
            $table->bigInteger('student_number')->unique()->change(); // Change to BIGINT with unique constraint
        });
    }

    public function down()
    {
        Schema::table('students', function (Blueprint $table) {
            $table->string('student_number')->unique()->change(); // Revert to string if rolled back
        });
    }
}
