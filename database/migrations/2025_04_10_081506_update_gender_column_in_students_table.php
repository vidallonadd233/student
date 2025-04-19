<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateGenderColumnInStudentsTable extends Migration
{
    public function up()
    {
        Schema::table('students', function (Blueprint $table) {
            // Modify the gender column to allow null values or set a default value
            $table->string('gender')->nullable()->default('Other')->change();
        });
    }

    public function down()
    {
        Schema::table('students', function (Blueprint $table) {
            // Revert changes (if necessary)
            $table->string('gender')->nullable(false)->change();
        });
    }
}
