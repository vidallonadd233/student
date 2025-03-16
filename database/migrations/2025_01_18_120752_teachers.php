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
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Name of the teacher
            $table->string('email')->unique(); // Unique email address
            $table->string('password'); // Encrypted password
            $table->string('profile_picture')->nullable(); // Profile picture, nullable in case it's optional
            $table->string('role')->default('teacher'); // Role of the teacher, default value 'teacher'
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};
