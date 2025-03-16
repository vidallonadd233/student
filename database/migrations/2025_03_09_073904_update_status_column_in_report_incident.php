<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('report_incident', function (Blueprint $table) {
            DB::statement("ALTER TABLE report_incident MODIFY COLUMN status ENUM('Unsolved', 'Solved', 'Archived') NOT NULL DEFAULT 'Unsolved'");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('report_incident', function (Blueprint $table) {
            DB::statement("ALTER TABLE report_incident MODIFY COLUMN status ENUM('Unsolved', 'Solved') NOT NULL");

        });
    }
};
