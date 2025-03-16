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
        Schema::create('report_archived', function (Blueprint $table) {
            $table->id();
            $table->integer('student_number');
            $table->integer('age');
            $table->date('date');
            $table->string('location');
            $table->string('category');
            $table->text('description')->nullable();
            $table->string('status');
            $table->string('evidence')->nullable();
            $table->string('gender', 10);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('report_archived');
    }
};
