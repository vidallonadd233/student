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
            $table->integer('grade_level')->change(); // Adjust to your desired type
            $table->integer('age')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('schedules', function (Blueprint $table) {
            $table->string('grade_level')->change(); // Revert back to original type, if necessary
            $table->string('age')->change(); // Revert back to original type, if necessary

        });
    }
};
