<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('login', function (Blueprint $table) {
            $table->id();
            $table->string('student_number')->unique(); // Unique student number
            $table->string('grade_level'); // Grade level field
            $table->integer('age'); // Age field
            $table->string('gender'); // Gender field
            $table->string('password'); // Password field
            $table->string('role'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('login');
    }
};
