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
            // Remove the 'assigned' column
            $table->dropColumn('assigned');

            // Add the new columns
            $table->string('person_involved');
            $table->enum('status', ['Unsolved', 'Solved'])->default('Unsolved');
            $table->text('description');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('report_incident', function (Blueprint $table) {
            // Add the 'assigned' column back
            $table->string('assigned');

            // Drop the newly added columns
            $table->dropColumn('person_involved');
            $table->dropColumn('status');
            $table->dropColumn('description');
        });
    }
};
        