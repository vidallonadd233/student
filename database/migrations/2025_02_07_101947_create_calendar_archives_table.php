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
        Schema::create('calendar_archives', function (Blueprint $table) {
            $table->id();
            $table->string('student_number');
        $table->integer('grade_level');
        $table->integer('age');
        $table->date('date');
        $table->time('time');
        $table->string('gender');
        $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calendar_archives');
    }
};
