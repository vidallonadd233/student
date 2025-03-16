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
        Schema::table('report_archived', function (Blueprint $table) {
            // Add the new column
            $table->date('report_date')->nullable();
        });

        // Copy data from the old column to the new column
        \DB::statement('UPDATE report_archived SET report_date = `date`');

        Schema::table('report_archived', function (Blueprint $table) {
            // Drop the old column
            $table->dropColumn('date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('report_archived', function (Blueprint $table) {
            // Add back the old column
            $table->date('date')->nullable();
        });

        // Copy data from the new column back to the old column
        \DB::statement('UPDATE report_archived SET `date` = report_date');

        Schema::table('report_archived', function (Blueprint $table) {
            // Drop the new column
            $table->dropColumn('report_date');
        });
    }
};
