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
        Schema::table('report_incident', function (Blueprint $table) {
            // Dropping the newly added columns
            $table->dropColumn('person_involved');
            $table->dropColumn('status');
            $table->dropColumn('description');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('report_incident', function (Blueprint $table) {
            // Re-adding the dropped columns (if you need to reverse the migration)
            $table->string('person_involved')->nullable();
            $table->enum('status', ['Unsolved', 'Solved'])->default('Unsolved');
            $table->text('description')->nullable();
        });
    }
};
