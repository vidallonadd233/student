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
        Schema::table('schedules', function (Blueprint $table) {
            DB::table('schedules')->whereNull('grade_level')->update(['grade_level' => 12]);  // Assign a default value
            DB::table('schedules')->whereNull('age')->update(['age' => 56]);  // Assign a default value
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('schedules', function (Blueprint $table) {
            $table->integer('grade_level')->change();  // Removes nullable
            $table->integer('age')->change();
        });
    }
};
